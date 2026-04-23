<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RSMS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Bootstrap CSS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: linear-gradient(135deg, #f8f9fc 0%, #eef2f7 100%);
                color: #1e293b;
            }
            .auth-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.5);
                border-radius: 1.5rem;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            }
            .btn-primary {
                background-color: #0a4297;
                border: none;
                padding: 0.8rem 1.5rem;
                border-radius: 0.8rem;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            .btn-primary:hover {
                background-color: #08367a;
                transform: translateY(-1px);
                box-shadow: 0 4px 12px rgba(10, 66, 151, 0.2);
            }
            .form-control {
                padding: 0.8rem 1rem;
                border-radius: 0.8rem;
                border: 1px solid #e2e8f0;
                background-color: #ffffff;
            }
            .form-control:focus {
                border-color: #0a4297;
                box-shadow: 0 0 0 4px rgba(10, 66, 151, 0.1);
            }
        </style>
    </head>
    <body>
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-5 px-3">
            <div class="auth-card w-100" style="max-width: 440px;">
                <div class="card-body p-4 p-md-5">
                    <div class="mb-5 text-center">
                        <a href="/" class="d-inline-block mb-4">
                            <div class="bg-primary text-white rounded-4 d-flex align-items-center justify-content-center mx-auto shadow-lg" style="width: 56px; height: 56px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-houses-fill" viewBox="0 0 16 16"><path d="M7.207 1a1 1 0 0 0-1.414 0L.146 6.646a.5.5 0 0 0 .708.708L1 7.207V12.5A1.5 1.5 0 0 0 2.5 14h.55a2.5 2.5 0 0 1-.05-.5V9.415a1.5 1.5 0 0 1-.56-2.475l5.353-5.354L7.207 1Z"/><path d="M8.793 2a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Z"/></svg>
                            </div>
                        </a>
                        <h2 class="fw-bold text-dark tracking-tighter h3">Summit Estate</h2>
                        <p class="text-secondary small">Experience the future of real estate</p>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
