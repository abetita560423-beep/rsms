<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View|RedirectResponse
    {
        return match ($request->user()->role) {
            User::ROLE_ADMIN => redirect()->route('dashboard.admin'),
            User::ROLE_STAFF => redirect()->route('dashboard.staff'),
            User::ROLE_SELLER => redirect()->route('properties.index'),
            default => $this->buyer(),
        };
    }

    public function admin(): View
    {
        $stats = [
            'users' => User::count(),
            'properties' => Property::where('status', Property::STATUS_APPROVED)->count(),
            'inquiries' => \App\Models\Inquiry::count(),
            'for_sale' => Property::where('type', Property::TYPE_SALE)->count(),
            'for_rent' => Property::where('type', Property::TYPE_RENT)->count(),
            'transactions' => \App\Models\Deal::count(),
            'revenue' => \App\Models\Deal::where('status', \App\Models\Deal::STATUS_COMPLETED)->sum('amount'),
        ];

        $latestUsers = User::latest()->take(5)->get();
        $latestProperties = Property::with('owner')->latest()->take(5)->get();
        $latestTransactions = \App\Models\Deal::with(['property', 'buyer'])->latest()->take(5)->get();
        $pendingApprovals = Property::with('owner')->where('status', Property::STATUS_PENDING)->latest()->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'latestUsers' => $latestUsers,
            'latestProperties' => $latestProperties,
            'latestTransactions' => $latestTransactions,
            'pendingApprovals' => $pendingApprovals,
        ]);
    }

    public function staff(): View
    {
        $stats = [
            'properties' => Property::count(),
            'pending' => Property::where('status', Property::STATUS_PENDING)->count(),
            'for_sale' => Property::where('type', Property::TYPE_SALE)->count(),
            'for_rent' => Property::where('type', Property::TYPE_RENT)->count(),
        ];

        $pendingApprovals = Property::with('owner')->where('status', Property::STATUS_PENDING)->latest()->get();

        return view('staff.dashboard', [
            'stats' => $stats,
            'pendingApprovals' => $pendingApprovals,
        ]);
    }

    public function seller(Request $request): View
    {
        $properties = Property::with('images')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->take(8)
            ->get();

        $stats = [
            'total' => $properties->count(),
            'for_sale' => $properties->where('type', Property::TYPE_SALE)->count(),
            'for_rent' => $properties->where('type', Property::TYPE_RENT)->count(),
        ];

        return view('seller.dashboard', [
            'stats' => $stats,
            'properties' => $properties,
        ]);
    }

    public function buyer(): View
    {
        $latestProperties = Property::with('images')
            ->latest()
            ->take(6)
            ->get();

        return view('buyer.dashboard', [
            'latestProperties' => $latestProperties,
        ]);
    }
}
