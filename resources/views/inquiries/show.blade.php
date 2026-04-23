<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ auth()->user()->isSeller() ? route('seller.inquiries') : route('buyer.inquiries') }}" class="btn btn-sm btn-light rounded-circle shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
            </a>
            <div>
                <h2 class="h4 fw-bold text-dark mb-0">Conversation regarding {{ $inquiry->property->title }}</h2>
                <small class="text-secondary">With {{ auth()->id() === $inquiry->sender_id ? $inquiry->receiver->name : $inquiry->sender->name }}</small>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Conversation Thread -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
                    <div class="card-body p-4" style="max-height: 600px; overflow-y: auto;">
                        <!-- Initial Message -->
                        <div class="d-flex mb-4 {{ $inquiry->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                            <div class="max-width-75">
                                <div class="p-3 rounded-4 {{ $inquiry->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light text-dark' }}">
                                    <div class="fw-bold small mb-1">{{ $inquiry->sender->name }}</div>
                                    <div>{{ $inquiry->message }}</div>
                                </div>
                                <div class="small text-muted mt-1 {{ $inquiry->sender_id === auth()->id() ? 'text-end' : '' }}">
                                    {{ $inquiry->created_at->format('M d, h:i A') }}
                                </div>
                            </div>
                        </div>

                        <!-- Replies -->
                        @foreach($inquiry->replies as $reply)
                            <div class="d-flex mb-4 {{ $reply->sender_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="max-width-75">
                                    <div class="p-3 rounded-4 {{ $reply->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light text-dark' }}">
                                        <div class="fw-bold small mb-1">{{ $reply->sender->name }}</div>
                                        <div>{{ $reply->message }}</div>
                                    </div>
                                    <div class="small text-muted mt-1 {{ $reply->sender_id === auth()->id() ? 'text-end' : '' }}">
                                        {{ $reply->created_at->format('M d, h:i A') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Reply Input -->
                    <div class="card-footer bg-white border-top-0 p-4 pt-0">
                        @if(auth()->id() === $inquiry->receiver_id && $inquiry->property->status === \App\Models\Property::STATUS_APPROVED)
                            <div class="mb-4 p-3 bg-light rounded-4 border">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold mb-1">Finalize Agreement</h6>
                                        <p class="small text-muted mb-0">Record this transaction and mark the property as sold/rented.</p>
                                    </div>
                                    <button type="button" class="btn btn-success rounded-pill px-4 fw-bold" data-bs-toggle="modal" data-bs-target="#finalizeModal">
                                        Finalize Deal
                                    </button>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('inquiry.reply', $inquiry) }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <textarea name="message" class="form-control border-0 bg-light rounded-4 p-3 shadow-none" rows="2" placeholder="Type your message here..." required></textarea>
                                <div class="d-flex align-items-end ms-2">
                                    <button type="submit" class="btn btn-primary rounded-4 px-4 py-3 fw-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16"><path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/></svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Property Summary Card -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <img src="{{ $inquiry->property->image ? asset('storage/' . $inquiry->property->image) : 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=400&auto=format&fit=crop' }}" class="w-100 h-100 object-fit-cover" alt="{{ $inquiry->property->title }}">
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="fw-bold mb-1">{{ $inquiry->property->title }}</h5>
                                <p class="text-secondary small mb-3">{{ $inquiry->property->location }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-primary fs-5">₱{{ number_format($inquiry->property->price, 0) }}</span>
                                    <a href="{{ route('property.details', $inquiry->property) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .max-width-75 { max-width: 75%; }
        .bg-light { background-color: #f8f9fc !important; }
    </style>

    <!-- Finalize Modal -->
    @if(auth()->id() === $inquiry->receiver_id)
    <div class="modal fade" id="finalizeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold">Finalize Agreement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="inquiry_id" value="{{ $inquiry->id }}">
                    <input type="hidden" name="property_id" value="{{ $inquiry->property_id }}">
                    <input type="hidden" name="buyer_id" value="{{ $inquiry->sender_id }}">
                    <input type="hidden" name="seller_id" value="{{ $inquiry->receiver_id }}">
                    
                    <div class="modal-body px-4 pb-4">
                        <p class="text-secondary small mb-4">Confirm the final agreed price for this transaction. This will mark the property as {{ $inquiry->property->type === 'sale' ? 'SOLD' : 'RENTED' }}.</p>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted">Final Price (₱)</label>
                            <input type="number" name="amount" class="form-control form-control-lg bg-light border-0 rounded-4" value="{{ $inquiry->property->price }}" required min="0">
                        </div>

                        <div class="alert alert-info border-0 rounded-4 small">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill me-2" viewBox="0 0 16 16"><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
                            This action is permanent and will be recorded in the system revenue.
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">Confirm & Finalize</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
