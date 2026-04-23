<footer class="bg-dark text-white pt-5 pb-4 mt-auto">
    <div class="container text-center text-md-start">
        <div class="row text-center text-md-start">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-primary">SummitHub</h5>
                <p class="small text-secondary">
                    Your premier destination for finding legacy properties and residential opportunities. Architectural precision meets curated lifestyle.
                </p>
            </div>

            <hr class="w-100 clearfix d-md-none">

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 fw-bold">Properties</h6>
                <p><a href="{{ route('properties.listing') }}" class="text-secondary text-decoration-none small">Buy Home</a></p>
                <p><a href="{{ route('properties.listing', ['type' => 'rent']) }}" class="text-secondary text-decoration-none small">Rent Home</a></p>
                <p><a href="{{ route('properties.listing') }}" class="text-secondary text-decoration-none small">Commercial</a></p>
            </div>

            <hr class="w-100 clearfix d-md-none">

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 fw-bold">Company</h6>
                <p><a href="{{ route('about') }}" class="text-secondary text-decoration-none small">About Us</a></p>
                <p><a href="#" class="text-secondary text-decoration-none small">Privacy Policy</a></p>
                <p><a href="#" class="text-secondary text-decoration-none small">Terms of Service</a></p>
            </div>

            <hr class="w-100 clearfix d-md-none">

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h6 class="text-uppercase mb-4 fw-bold">Contact</h6>
                <p class="small text-secondary"><i class="fas fa-home mr-3"></i> 123 Luxury Dr, CA 90210, US</p>
                <p class="small text-secondary"><i class="fas fa-envelope mr-3"></i> contact@summit-hub.com</p>
                <p class="small text-secondary"><i class="fas fa-phone mr-3"></i> +1 234 567 88</p>
            </div>
        </div>

        <hr class="my-3 opacity-25">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p class="small text-secondary">© {{ date('Y') }} All Rights Reserved:
                    <a href="#" class="text-decoration-none"><strong class="text-primary">SummitHub</strong></a>
                </p>
            </div>
            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-end">
                    <ul class="list-unstyled list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-secondary" style="font-size: 23px;"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-secondary" style="font-size: 23px;"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-secondary" style="font-size: 23px;"><i class="fab fa-instagram"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
