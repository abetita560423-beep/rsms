<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'buyer_id' => ['required', 'exists:users,id'],
            'seller_id' => ['required', 'exists:users,id'],
            'inquiry_id' => ['required', 'exists:inquiries,id'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);

        return DB::transaction(function () use ($validated) {
            $property = Property::findOrFail($validated['property_id']);
            
            // 1. Create Deal
            $transaction = Deal::create([
                'property_id' => $validated['property_id'],
                'buyer_id' => $validated['buyer_id'],
                'seller_id' => $validated['seller_id'],
                'inquiry_id' => $validated['inquiry_id'],
                'amount' => $validated['amount'],
                'status' => Deal::STATUS_COMPLETED,
            ]);

            // 2. Update Property Status
            $newStatus = ($property->type === Property::TYPE_SALE) ? Property::STATUS_SOLD : Property::STATUS_RENTED;
            $property->update(['status' => $newStatus]);

            // 3. Notify Buyer
            User::find($validated['buyer_id'])->notifications()->create([
                'type' => 'transaction_finalized',
                'message' => "Congratulations! The agreement for '{$property->title}' has been finalized for ₱" . number_format($validated['amount'], 2),
            ]);

            return back()->with('status', 'Transaction finalized and property status updated.');
        });
    }

    public function index(): \Illuminate\View\View
    {
        $transactions = Deal::with(['property', 'buyer', 'seller'])
            ->latest()
            ->paginate(15);

        return view('admin.transactions.index', [
            'transactions' => $transactions,
        ]);
    }

    public function sellerTransactions(): \Illuminate\View\View
    {
        $transactions = Deal::with(['property', 'buyer'])
            ->where('seller_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('seller.transactions', [
            'transactions' => $transactions,
        ]);
    }

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
}
