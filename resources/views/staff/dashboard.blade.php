<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-dark mb-0">
            {{ __('Management Panel') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="mb-5">
            <h1 class="display-6 fw-bold text-dark mb-2">Staff Dashboard</h1>
            <p class="text-secondary fs-5">Welcome, {{ auth()->user()->name }}. Review and moderate property listings.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 bg-primary text-white p-4">
                    <h3 class="fw-bold mb-1">{{ $stats['pending'] }}</h3>
                    <p class="small mb-0 text-uppercase fw-bold opacity-75">Pending Approvals</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm rounded-4 bg-white p-4">
                    <h3 class="fw-bold mb-1 text-dark">{{ $stats['properties'] }}</h3>
                    <p class="small mb-0 text-secondary text-uppercase fw-bold">Total Properties</p>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 bg-white">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold text-dark mb-0">Moderation Queue</h5>
                <a href="{{ route('admin.properties.pending') }}" class="btn btn-sm btn-outline-primary fw-bold">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 mt-3 border-top">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4 text-uppercase small fw-semibold text-secondary py-3 border-0">Property</th>
                                <th class="text-uppercase small fw-semibold text-secondary py-3 border-0">Seller</th>
                                <th class="text-uppercase small fw-semibold text-secondary py-3 border-0">Price</th>
                                <th class="pe-4 text-uppercase small fw-semibold text-secondary text-end py-3 border-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingApprovals as $approval)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="fw-bold text-dark">{{ $approval->title }}</div>
                                        <small class="text-muted">{{ $approval->location }}</small>
                                    </td>
                                    <td class="py-3">
                                        <div class="fw-medium text-dark">{{ $approval->owner->name }}</div>
                                    </td>
                                    <td class="fw-bold text-primary py-3">${{ number_format($approval->price, 0) }}</td>
                                    <td class="pe-4 text-end py-3">
                                        <div class="d-flex justify-content-end gap-2">
                                            <form action="{{ route('admin.property.approve', $approval) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success fw-bold px-3 shadow-sm">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.property.reject', $approval) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger fw-bold px-3">Reject</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">No properties awaiting approval.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
