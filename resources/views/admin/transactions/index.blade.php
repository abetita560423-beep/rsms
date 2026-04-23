<x-app-layout>
    <x-slot name="header">
        {{ __('Transaction History') }}
    </x-slot>

    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
            <h5 class="fw-bold text-dark mb-0">Platform Transactions</h5>
            <p class="small text-muted mt-1">Detailed history of all finalized property agreements.</p>
        </div>
        <div class="table-responsive mt-3">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-muted small fw-bold text-uppercase">Property</th>
                        <th class="py-3 text-muted small fw-bold text-uppercase">Buyer</th>
                        <th class="py-3 text-muted small fw-bold text-uppercase">Seller</th>
                        <th class="py-3 text-muted small fw-bold text-uppercase">Amount</th>
                        <th class="py-3 text-muted small fw-bold text-uppercase">Status</th>
                        <th class="pe-4 py-3 text-muted small fw-bold text-uppercase text-end">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $tx)
                        <tr>
                            <td class="ps-4 py-3">
                                <div class="fw-bold text-dark">{{ $tx->property->title }}</div>
                                <span class="badge bg-light text-secondary small">{{ strtoupper($tx->property->type) }}</span>
                            </td>
                            <td class="py-3">
                                <div class="fw-medium text-dark">{{ $tx->buyer->name }}</div>
                                <small class="text-muted">{{ $tx->buyer->email }}</small>
                            </td>
                            <td class="py-3">
                                <div class="fw-medium text-dark">{{ $tx->seller->name }}</div>
                                <small class="text-muted">{{ $tx->seller->email }}</small>
                            </td>
                            <td class="py-3 fw-bold text-dark">₱{{ number_format($tx->amount, 2) }}</td>
                            <td class="py-3">
                                <span class="badge bg-success rounded-pill px-3">{{ ucfirst($tx->status) }}</span>
                            </td>
                            <td class="pe-4 py-3 text-end text-muted small">
                                {{ $tx->created_at->format('M d, Y') }}<br>
                                <span class="opacity-50">{{ $tx->created_at->format('h:i A') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No transactions recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
            <div class="card-footer bg-white border-0 py-3 px-4">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
