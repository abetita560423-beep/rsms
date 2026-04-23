<x-app-layout>
    <x-slot name="header">
        {{ __('Admin Dashboard') }}
    </x-slot>

    <!-- Stats Grid -->
    <div class="row g-4 mb-5">
        <div class="col-sm-6 col-lg-3">
            <div class="card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16"><path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4-1 1-1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/></svg>
                    </div>
                </div>
                <h3 class="fw-bold text-dark mb-0">{{ number_format($stats['users'] ?? 0) }}</h3>
                <p class="text-secondary small mb-0 fw-bold text-uppercase opacity-75">Users</p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16"><path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1ZM4 8.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1Zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1Z"/><path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1Zm11 0H3v14h3v-4h4v4h3V1Z"/></svg>
                    </div>
                </div>
                <h3 class="fw-bold text-dark mb-0">{{ number_format($stats['properties'] ?? 0) }}</h3>
                <p class="text-secondary small mb-0 fw-bold text-uppercase opacity-75">Properties</p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-4 h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart-check" viewBox="0 0 16 16"><path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg>
                    </div>
                </div>
                <h3 class="fw-bold text-dark mb-0">{{ number_format($stats['transactions'] ?? 0) }}</h3>
                <p class="text-secondary small mb-0 fw-bold text-uppercase opacity-75">Transactions</p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card p-4 bg-primary text-white h-100 border-0 shadow-lg">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-white bg-opacity-20 text-white rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16"><path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.5-1.5H2V1.78a1.5 1.5 0 0 1 1.864-1.454L12.136.326zM14 5.5a.5.5 0 0 0-.5-.5h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9z"/></svg>
                    </div>
                </div>
                <h3 class="fw-bold mb-0">₱{{ number_format($stats['revenue'] ?? 0, 2) }}</h3>
                <p class="small mb-0 fw-bold text-uppercase opacity-75">Total Revenue</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Transactions -->
        <div class="col-lg-7">
            <div class="card overflow-hidden bg-white h-100 shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0">Recent Transactions</h5>
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-bold">View All</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3 text-muted small fw-bold text-uppercase">Property</th>
                                <th class="py-3 text-muted small fw-bold text-uppercase">Amount</th>
                                <th class="pe-4 py-3 text-muted small fw-bold text-uppercase text-end">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestTransactions as $tx)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="fw-bold text-dark">{{ $tx->property->title }}</div>
                                        <small class="text-muted">By {{ $tx->buyer->name }}</small>
                                    </td>
                                    <td class="py-3 fw-bold text-success">₱{{ number_format($tx->amount, 0) }}</td>
                                    <td class="pe-4 py-3 text-end text-muted small">{{ $tx->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">No transactions yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Approval Queue -->
        <div class="col-lg-5">
            <div class="card overflow-hidden bg-white h-100 shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 pt-4 pb-0 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0">Pending Approvals</h5>
                    <a href="{{ route('admin.properties.pending') }}" class="btn btn-sm btn-light rounded-pill px-3 fw-bold">View Queue</a>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-hover align-middle mb-0">
                        <tbody>
                            @forelse($pendingApprovals as $approval)
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="fw-bold text-dark text-truncate" style="max-width: 150px;">{{ $approval->title }}</div>
                                        <small class="text-muted">₱{{ number_format($approval->price, 0) }}</small>
                                    </td>
                                    <td class="pe-4 py-3 text-end">
                                        <form action="{{ route('admin.property.approve', $approval) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success px-3 fw-bold rounded-pill">Approve</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-5 text-muted">No pending listings.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
