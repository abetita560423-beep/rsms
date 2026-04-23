<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-dark mb-0">
            {{ __('My Inquiries') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                    <div class="card-header bg-white border-bottom pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold text-dark mb-0">Inbox</h5>
                        @php $unreadCount = $inquiries->where('status', 'unread')->count(); @endphp
                        @if($unreadCount > 0)
                            <span class="badge bg-primary rounded-pill">{{ $unreadCount }} New</span>
                        @endif
                    </div>
                    
                    <div class="list-group list-group-flush">
                        @forelse($inquiries as $inquiry)
                            <div class="list-group-item list-group-item-action p-4 {{ $inquiry->status === 'unread' ? 'bg-primary bg-opacity-10' : '' }} border-bottom">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-secondary text-white rounded-circle d-flex justify-content-center align-items-center fw-bold" style="width: 45px; height: 45px;">
                                            {{ substr($inquiry->sender->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark">{{ $inquiry->sender->name }}</h6>
                                            <small class="{{ $inquiry->status === 'unread' ? 'text-primary' : 'text-muted' }} fw-semibold">
                                                Regarding: {{ $inquiry->property->title }}
                                            </small>
                                        </div>
                                    </div>
                                    <small class="text-muted fw-medium">{{ $inquiry->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-3 text-dark" style="padding-left: 60px;">
                                    {{ $inquiry->message }}
                                </p>
                                <div class="d-flex justify-content-end gap-2">
                                    @if($inquiry->status === 'unread')
                                        <form action="{{ route('inquiry.mark-read', $inquiry) }}" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary px-3">Mark as Read</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('inquiry.destroy', $inquiry) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none fw-bold" onclick="return confirm('Delete this conversation?')">Delete</button>
                                    </form>
                                    <a href="{{ route('inquiry.show', $inquiry) }}" class="btn btn-sm btn-primary px-4 fw-medium shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-chat-text-fill me-1" viewBox="0 0 16 16"><path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z"/></svg>
                                        Open Chat
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="p-5 text-center text-muted">
                                No inquiries received yet.
                            </div>
                        @endforelse
                    </div>
                    
                    @if($inquiries->hasPages())
                        <div class="card-footer bg-white border-0 py-3">
                            {{ $inquiries->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
