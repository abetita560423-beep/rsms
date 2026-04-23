<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-dark mb-0">
            {{ __('My Sent Inquiries') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
                    <div class="card-header bg-white border-bottom pt-4 pb-3 px-4">
                        <h5 class="fw-bold text-dark mb-0">Sent Messages</h5>
                    </div>
                    
                    <div class="list-group list-group-flush">
                        @forelse($inquiries as $inquiry)
                            <div class="list-group-item p-4 border-bottom">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center fw-bold" style="width: 45px; height: 45px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-send-fill" viewBox="0 0 16 16"><path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.001.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/></svg>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark">To: {{ $inquiry->receiver->name }}</h6>
                                            <small class="text-muted fw-semibold">
                                                Regarding: {{ $inquiry->property->title }}
                                            </small>
                                        </div>
                                    </div>
                                    <small class="text-muted fw-medium">{{ $inquiry->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-2 text-dark" style="padding-left: 60px;">
                                    {{ $inquiry->message }}
                                </p>
                                <div class="d-flex justify-content-end align-items-center gap-2" style="padding-left: 60px;">
                                    <form action="{{ route('inquiry.destroy', $inquiry) }}" method="POST" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-link text-danger text-decoration-none fw-bold me-2" onclick="return confirm('Delete this inquiry history?')">Delete</button>
                                    </form>
                                    <a href="{{ route('inquiry.show', $inquiry) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold me-2">Open Chat</a>
                                    <a href="{{ route('property.details', $inquiry->property) }}" class="btn btn-sm btn-link text-primary fw-bold text-decoration-none">View Property</a>
                                </div>
                            </div>
                        @empty
                            <div class="p-5 text-center text-muted">
                                You haven't sent any inquiries yet.
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
