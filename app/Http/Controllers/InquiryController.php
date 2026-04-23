<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Property;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'property_id' => ['required', 'exists:properties,id'],
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $property = Property::findOrFail($request->property_id);

        $inquiry = Inquiry::create([
            'property_id' => $validated['property_id'],
            'sender_id' => $request->user()->id,
            'receiver_id' => $property->user_id,
            'message' => $validated['message'],
        ]);

        $property->owner->notifications()->create([
            'type' => 'new_inquiry',
            'message' => "You have received a new inquiry for '{$property->title}'.",
        ]);

        return back()->with('status', 'Inquiry sent successfully.');
    }

    public function sellerInbox(Request $request): View
    {
        $inquiries = Inquiry::with(['sender', 'property'])
            ->where('receiver_id', $request->user()->id)
            ->latest()
            ->paginate(15);

        return view('seller.inquiries', [
            'inquiries' => $inquiries,
        ]);
    }

    public function buyerSent(Request $request): View
    {
        $inquiries = Inquiry::with(['receiver', 'property'])
            ->where('sender_id', $request->user()->id)
            ->latest()
            ->paginate(15);

        return view('buyer.inquiries', [
            'inquiries' => $inquiries,
        ]);
    }
    
    public function markAsRead(Inquiry $inquiry): RedirectResponse
    {
        if ($inquiry->receiver_id !== auth()->id()) {
            abort(403);
        }
        
        $inquiry->update(['status' => 'read']);
        
        return back();
    }

    public function show(Inquiry $inquiry): View
    {
        if ($inquiry->sender_id !== auth()->id() && $inquiry->receiver_id !== auth()->id()) {
            abort(403);
        }

        // Mark as read if receiver views it
        if ($inquiry->receiver_id === auth()->id()) {
            $inquiry->update(['status' => 'read']);
        }

        $inquiry->load(['replies.sender', 'sender', 'receiver', 'property']);

        return view('inquiries.show', [
            'inquiry' => $inquiry,
        ]);
    }

    public function reply(Request $request, Inquiry $inquiry): RedirectResponse
    {
        if ($inquiry->sender_id !== auth()->id() && $inquiry->receiver_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        // Determine who is the receiver of the reply
        $receiver_id = (auth()->id() === $inquiry->sender_id) ? $inquiry->receiver_id : $inquiry->sender_id;

        $reply = Inquiry::create([
            'parent_id' => $inquiry->id,
            'property_id' => $inquiry->property_id,
            'sender_id' => auth()->id(),
            'receiver_id' => $receiver_id,
            'message' => $validated['message'],
        ]);

        // Notify the other party
        \App\Models\User::find($receiver_id)->notifications()->create([
            'type' => 'new_message',
            'message' => "You have a new message from " . auth()->user()->name . " regarding '{$inquiry->property->title}'.",
        ]);

        return back()->with('status', 'Message sent successfully.');
    }

    public function destroy(Inquiry $inquiry): RedirectResponse
    {
        if ($inquiry->sender_id !== auth()->id() && $inquiry->receiver_id !== auth()->id()) {
            abort(403);
        }

        $inquiry->delete();

        return back()->with('status', 'Conversation deleted successfully.');
    }
}
