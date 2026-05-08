<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Inquiry;
use App\Models\Notification;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Admin: view all transactions.
     */
    public function index(): \Illuminate\View\View
    {
        $transactions = Deal::with(['property', 'buyer', 'seller'])
            ->latest()
            ->paginate(15);

        return view('admin.transactions.index', [
            'transactions' => $transactions,
        ]);
    }

    /**
     * Seller: view My Sales page with pending inquiries for the payment request modal.
     */
    public function sellerTransactions(): \Illuminate\View\View
    {
        $allDeals = Deal::where('seller_id', auth()->id())->get();
        
        $transactions = Deal::with(['property', 'buyer', 'inquiry'])
            ->where('seller_id', auth()->id())
            ->latest()
            ->paginate(15);

        // Load open inquiries for the "Send Payment Request" modal
        $openInquiries = Inquiry::with(['property', 'sender'])
            ->where('receiver_id', auth()->id())
            ->whereNull('parent_id')
            ->whereDoesntHave('deal')
            ->latest()
            ->get();

        return view('seller.transactions', [
            'transactions' => $transactions,
            'openInquiries' => $openInquiries,
            'stats' => [
                'completed' => $allDeals->where('status', Deal::STATUS_COMPLETED)->count(),
                'buyer_confirmed' => $allDeals->where('status', Deal::STATUS_BUYER_CONFIRMED)->count(),
                'pending' => $allDeals->where('status', Deal::STATUS_PENDING)->count(),
                'total_earnings' => $allDeals->where('status', Deal::STATUS_COMPLETED)->sum('amount'),
            ]
        ]);
    }

    /**
     * Buyer: view My Purchases page.
     */
    public function buyerTransactions(): \Illuminate\View\View
    {
        $transactions = Deal::with(['property', 'seller'])
            ->where('buyer_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('buyer.transactions', [
            'transactions' => $transactions,
        ]);
    }

    /**
     * Seller sends a payment request (creates a PENDING deal).
     */
    public function sendPaymentRequest(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'inquiry_id'  => ['required', 'exists:inquiries,id'],
            'amount'      => ['required', 'numeric', 'min:0'],
            'seller_note' => ['nullable', 'string', 'max:500'],
        ]);

        $inquiry = Inquiry::with('property')->findOrFail($validated['inquiry_id']);

        // Ensure current user is the receiver (seller) of this inquiry
        if ($inquiry->receiver_id !== auth()->id()) {
            abort(403);
        }

        // Prevent duplicate payment requests
        if (Deal::where('inquiry_id', $inquiry->id)->exists()) {
            return back()->with('error', 'A payment request already exists for this inquiry.');
        }

        // Create pending deal
        Deal::create([
            'property_id' => $inquiry->property_id,
            'buyer_id'    => $inquiry->sender_id,
            'seller_id'   => auth()->id(),
            'inquiry_id'  => $inquiry->id,
            'amount'      => $validated['amount'],
            'seller_note' => $validated['seller_note'] ?? null,
            'status'      => Deal::STATUS_PENDING,
        ]);

        // Notify buyer
        User::find($inquiry->sender_id)->notifications()->create([
            'type'    => Notification::TYPE_PAYMENT_REQUEST,
            'message' => "You have received a payment request of ₱" . number_format($validated['amount'], 0) . " for '{$inquiry->property->title}'. Please review it in My Purchases.",
        ]);

        return back()->with('status', 'Payment request sent to buyer successfully.');
    }

    /**
     * Step 2: Buyer confirms they have sent payment.
     */
    public function confirm(Request $request, Deal $deal): RedirectResponse
    {
        // Only the buyer can confirm
        if ($deal->buyer_id !== auth()->id()) {
            abort(403);
        }

        if ($deal->status !== Deal::STATUS_PENDING) {
            return back()->with('error', 'This deal is no longer awaiting your confirmation.');
        }

        $deal->update([
            'status' => Deal::STATUS_BUYER_CONFIRMED,
            'buyer_confirmed_at' => now(),
        ]);

        // Notify seller
        User::find($deal->seller_id)->notifications()->create([
            'type'    => Notification::TYPE_BUYER_CONFIRMED_PAYMENT,
            'message' => "The buyer has confirmed sending payment for '{$deal->property->title}'. Please verify and finalize the deal.",
        ]);

        return back()->with('status', 'Confirmation sent! Awaiting seller to verify receipt and finalize.');
    }

    /**
     * Buyer or seller rejects a pending offer.
     */
    public function reject(Request $request, Deal $deal): RedirectResponse
    {
        $isParticipant = in_array(auth()->id(), [$deal->buyer_id, $deal->seller_id], true);
        if (! $isParticipant) {
            abort(403);
        }

        if ($deal->status !== Deal::STATUS_PENDING) {
            return back()->with('error', 'Only pending offers can be rejected.');
        }

        $deal->update(['status' => Deal::STATUS_CANCELLED]);

        return back()->with('status', 'Offer rejected successfully.');
    }

    /**
     * Step 3: Seller verifies receipt and finalizes the deal.
     */
    public function finalize(Request $request, Deal $deal): RedirectResponse
    {
        // Only the seller can finalize
        if ($deal->seller_id !== auth()->id()) {
            abort(403);
        }

        if ($deal->status !== Deal::STATUS_BUYER_CONFIRMED) {
            return back()->with('error', 'This deal is not yet confirmed by the buyer.');
        }

        return DB::transaction(function () use ($deal) {
            $deal->update(['status' => Deal::STATUS_COMPLETED]);

            // Update property status
            $property = $deal->property;
            $newStatus = ($property->type === Property::TYPE_SALE)
                ? Property::STATUS_SOLD
                : Property::STATUS_RENTED;
            $property->update(['status' => $newStatus]);

            // Notify buyer
            User::find($deal->buyer_id)->notifications()->create([
                'type'    => Notification::TYPE_DEAL_FINALIZED,
                'message' => "The seller has confirmed receipt of payment for '{$property->title}'. The deal is now complete!",
            ]);

            return back()->with('status', 'Deal finalized successfully! The property is now marked as ' . $newStatus . '.');
        });
    }

    /**
     * Legacy: direct store (kept for admin/backward compat).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'buyer_id'    => ['required', 'exists:users,id'],
            'seller_id'   => ['required', 'exists:users,id'],
            'inquiry_id'  => ['required', 'exists:inquiries,id'],
            'amount'      => ['required', 'numeric', 'min:0'],
        ]);

        return DB::transaction(function () use ($validated) {
            $property = Property::findOrFail($validated['property_id']);

            $transaction = Deal::create([
                'property_id' => $validated['property_id'],
                'buyer_id'    => $validated['buyer_id'],
                'seller_id'   => $validated['seller_id'],
                'inquiry_id'  => $validated['inquiry_id'],
                'amount'      => $validated['amount'],
                'status' => Deal::STATUS_COMPLETED,
            ]);

            $newStatus = ($property->type === Property::TYPE_SALE) ? Property::STATUS_SOLD : Property::STATUS_RENTED;
            $property->update(['status' => $newStatus]);

            User::find($validated['buyer_id'])->notifications()->create([
                'type'    => Notification::TYPE_DEAL_FINALIZED,
                'message' => "Congratulations! The agreement for '{$property->title}' has been finalized for ₱" . number_format($validated['amount'], 2),
            ]);

            return back()->with('status', 'Transaction finalized.');
        });
    }
}
