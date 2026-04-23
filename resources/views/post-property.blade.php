<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 fw-bold text-dark mb-0">
            {{ __('Post Property') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 bg-white">
                    <div class="card-body p-4 p-md-5">
                        <h4 class="fw-bold mb-4 text-dark">Property Details</h4>
                        @include('properties._form', [
                            'formAction' => route('properties.store'),
                            'submitLabel' => 'Submit Property',
                            'cancelRoute' => route('properties.listing'),
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
