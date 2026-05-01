<x-app-layout>
    <x-slot name="header">My Purchases</x-slot>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Summary Stats --}}
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"/></svg>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">{{ $transactions->where('status', 'completed')->count() }}</h3>
                        <p class="text-secondary small mb-0 fw-bold text-uppercase">Finalized Purchases</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4 bg-primary text-white h-100 border-0 shadow">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 text-white rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16"><path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/><path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/></svg>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">₱{{ number_format($transactions->where('status', 'completed')->sum('amount'), 0) }}</h3>
                        <p class="small mb-0 fw-bold text-uppercase opacity-75">Total Spent</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Transactions Table --}}
    <div class="card overflow-hidden bg-white">
        <div class="card-header bg-white border-bottom pt-4 pb-3 px-4">
            <h5 class="fw-bold text-dark mb-0">Your Consensus Agreements</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Property</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Seller</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Price / Offer</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Status</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $deal)
                        <tr class="{{ $deal->status === 'pending' ? 'table-warning' : '' }}">
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{ $deal->property->image ? asset('storage/' . $deal->property->image) : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=100&auto=format&fit=crop' }}"
                                         class="rounded-3 shadow-sm" width="52" height="52" style="object-fit:cover;">
                                    <div>
                                        <div class="fw-bold text-dark">{{ $deal->property->title }}</div>
                                        <small class="text-muted">{{ $deal->property->location }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="fw-semibold text-dark">{{ $deal->seller->name }}</div>
                                <small class="text-muted">{{ $deal->seller->email }}</small>
                            </td>
                            <td class="px-4 py-3">
                                <div class="fw-bold text-dark">₱{{ number_format($deal->amount, 0) }}</div>
                                @if($deal->seller_note)
                                    <small class="text-muted fst-italic">"{{ $deal->seller_note }}"</small>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $badgeClass = match($deal->status) {
                                        'completed' => 'bg-success',
                                        'buyer_confirmed' => 'bg-primary',
                                        'cancelled' => 'bg-danger',
                                        default => 'bg-warning text-dark',
                                    };
                                    $label = match($deal->status) {
                                        'completed' => 'Completed',
                                        'buyer_confirmed' => 'Awaiting Seller Receipt',
                                        'cancelled' => 'Cancelled',
                                        default => 'Action Required',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} fw-bold" style="font-size:0.7rem;">{{ $label }}</span>
                            </td>
                            <td class="px-4 py-3 text-end">
                                @if($deal->status === 'pending')
                                    <button class="btn btn-success btn-sm rounded-pill px-3 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $deal->id }}">
                                        Confirm & Send Payment
                                    </button>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                        </tr>

                        @if($deal->status === 'pending')
                            <div class="modal fade" id="confirmModal-{{ $deal->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow rounded-4">
                                        <div class="modal-header border-0 pt-4 px-4">
                                            <h5 class="modal-title fw-bold">Consensus Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body px-4">
                                            <p class="text-muted small mb-4">By clicking confirm, you acknowledge that you have sent the agreed payment to the seller.</p>
                                            <div class="p-3 bg-light rounded-4 mb-4">
                                                <div class="small text-muted">Final Price</div>
                                                <div class="fw-bold text-success fs-4">₱{{ number_format($deal->amount, 0) }}</div>
                                            </div>
                                            <div class="alert alert-info border-0 rounded-4 small">
                                                Once you confirm, the seller will verify their receipt of funds to fully finalize the deal.
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 px-4 pb-4">
                                            <form action="{{ route('transactions.confirm', $deal) }}" method="POST" class="m-0">
                                                @csrf
                                                <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold">
                                                    I've Sent Payment
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No purchases yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
