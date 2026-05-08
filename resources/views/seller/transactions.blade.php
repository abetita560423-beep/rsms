<x-app-layout>
    <x-slot name="header">My Sales</x-slot>

    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Summary Stats --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16"><path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/><path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/></svg>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">{{ $stats['completed'] }}</h3>
                        <p class="text-secondary small mb-0 fw-bold text-uppercase">Closed Deals</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 h-100 border-primary border-opacity-25">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/><path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.611-.35-.985-1.039-1.247l-.266-.105c-.43-.169-.733-.305-.733-.608 0-.296.256-.494.633-.494.39 0 .62.19.65.503h.365c-.039-.56-.474-.984-1.243-1.044v-.44h-.375v.445c-.747.056-1.266.472-1.266 1.109 0 .641.366 1.012 1.05 1.273l.265.103c.454.172.744.317.744.623 0 .31-.213.52-.634.52-.421 0-.708-.21-.74-.54h-.365z"/></svg>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">{{ $stats['buyer_confirmed'] }}</h3>
                        <p class="text-secondary small mb-0 fw-bold text-uppercase">Awaiting Receipt</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 h-100">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-hourglass-split" viewBox="0 0 16 16"><path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/></svg>
                    </div>
                    <div>
                        <h3 class="fw-bold text-dark mb-0">{{ $stats['pending'] }}</h3>
                        <p class="text-secondary small mb-0 fw-bold text-uppercase">Offers Out</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4 bg-primary text-white h-100 border-0 shadow">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 text-white rounded-3 p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16"><path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.5-1.5H2V1.78a1.5 1.5 0 0 1 1.864-1.454L12.136.326zM14 5.5a.5.5 0 0 0-.5-.5h-13a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9z"/></svg>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">₱{{ number_format($stats['total_earnings'], 0) }}</h3>
                        <p class="small mb-0 fw-bold text-uppercase opacity-75">Total Earnings</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Send Payment Request CTA --}}
    @if($openInquiries->isNotEmpty())
        <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fw-bold text-dark mb-1">New Inquiry?</h6>
                    <p class="text-muted small mb-0">Initiate a payment request to start the consensus deal process.</p>
                </div>
                <button class="btn btn-success rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#paymentRequestModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-2" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/></svg>
                    Create Payment Request
                </button>
            </div>
        </div>
    @endif

    {{-- Transaction History Table --}}
    <div class="card overflow-hidden bg-white">
        <div class="card-header bg-white border-bottom pt-4 pb-3 px-4">
            <h5 class="fw-bold text-dark mb-0">Consensus Deal History</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Property</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Buyer</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Price / Offer</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase">Status</th>
                        <th class="px-4 py-3 text-muted small fw-bold text-uppercase text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $deal)
                        <tr class="{{ $deal->status === 'buyer_confirmed' ? 'bg-primary bg-opacity-10' : '' }}">
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
                                <div class="fw-semibold text-dark">{{ $deal->buyer->name }}</div>
                                <small class="text-muted">{{ $deal->buyer->email }}</small>
                            </td>
                            <td class="px-4 py-3">
                                <div class="fw-bold text-dark">₱{{ number_format($deal->amount, 0) }}</div>
                                @if($deal->buyer_confirmed_at)
                                    <small class="text-primary fw-bold">
                                        Buyer paid:
                                        {{ \Illuminate\Support\Carbon::parse($deal->buyer_confirmed_at)->format('M d, H:i') }}
                                    </small>
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
                                        'buyer_confirmed' => 'Verify Receipt',
                                        'cancelled' => 'Cancelled',
                                        default => 'Awaiting Buyer',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} fw-bold" style="font-size:0.7rem;">{{ $label }}</span>
                            </td>
                            <td class="px-4 py-3 text-end">
                                @if($deal->status === 'buyer_confirmed')
                                    <form action="{{ route('transactions.finalize', $deal) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm rounded-pill px-3 fw-bold shadow-sm" onclick="return confirm('Confirm that you have received the payment of ₱{{ number_format($deal->amount, 0) }}?')">
                                            Verify & Done
                                        </button>
                                    </form>
                                @elseif($deal->status === 'pending')
                                    <form action="{{ route('transactions.reject', $deal) }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold" onclick="return confirm('Cancel this offer?')">
                                            Cancel Offer
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small">—</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                No consensus deals recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Payment Request Modal (Same as before but with consensus messaging) --}}
    <div class="modal fade" id="paymentRequestModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 pt-4 px-4">
                    <div>
                        <h5 class="modal-title fw-bold">Initiate Consensus Deal</h5>
                        <p class="text-muted small mb-0">The buyer will need to confirm payment before you can finalize.</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('transactions.payment-request') }}" method="POST">
                    @csrf
                    <div class="modal-body px-4 pb-2">
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted">Select Inquiry</label>
                            <select name="inquiry_id" id="inquirySelect" class="form-select bg-light border-0 rounded-4" required>
                                <option value="">— Choose —</option>
                                @foreach($openInquiries as $inq)
                                    <option value="{{ $inq->id }}" data-price="{{ $inq->property->price }}" data-title="{{ $inq->property->title }}">
                                        {{ $inq->property->title }} — {{ $inq->sender->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Agreed Price (₱)</label>
                            <input type="number" name="amount" id="finalAmount" class="form-control form-control-lg bg-light border-0 rounded-4" required min="0">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Note to Buyer</label>
                            <textarea name="seller_note" class="form-control bg-light border-0 rounded-4" rows="2" placeholder="e.g. Please send payment to Gcash 09123456789."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold">Send Offer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('inquirySelect').addEventListener('change', function() {
            const price = this.options[this.selectedIndex].dataset.price;
            if(price) document.getElementById('finalAmount').value = price;
        });
    </script>
</x-app-layout>
