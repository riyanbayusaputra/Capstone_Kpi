@extends('../layouts.master1')

@section('content')

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow sticky-top p-0">
            <a href="{{ route('frontend.index') }}" class="navbar-brand d-flex align-items-center py-0 px-4 px-lg-5">
                <span class="fs-4 fw-bold text-white">AyoKerja.co</span>
            </a>

            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav d-flex justify-content-center w-100">
                    <a href="{{ route('frontend.index') }}" class="nav-item nav-link">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Layanan</a>
                        <div class="dropdown-menu rounded-0 m-0 bg-dark">
                            <a href="#" class="dropdown-item text-light">Pelatihan</a>
                            <a href="{{ route('frontend.webinar') }}" class="dropdown-item text-light">Webinar</a>
                            <a href="{{ route('psikotes.index') }}" class="dropdown-item text-light">Psikotes</a>
                            <a href="{{ route('tmb.index') }}" class="dropdown-item text-light">Test Minat Bakat</a>
                        </div>
                    </div>
                    <a href="{{ route('informasi-pribadi.index') }}" class="nav-item nav-link">CV ats</a>
                </div>
                @guest
                <div class="d-flex align-items-center gap-2 me-4">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-3 px-2 py-1">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary rounded-3 px-2 py-1">Register</a>
                </div>
                @endguest
                @auth
                <div class="dropdown ms-auto p-4">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="photo" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover;">
                        <span class="d-none d-lg-block ms-2 text-light text-uppercase fw-bold">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUser" style="margin-right: 15px;">
                        <li class="text-center">
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="photo" class="rounded-circle mb-3" style="width: 60px; height: 60px; object-fit: cover;">
                            <h6 class="mb-3 text-uppercase">{{ Auth::user()->name }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Keluar
                            </a>
                        </li>
                    </ul>
                </div>
                @endauth

            </div>
        </nav>
        <!-- Navbar End -->



        <!-- Search Start -->
        <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <form action="{{ route('frontend.search') }}" method="GET">
                    <div class="row g-2 justify-content-center">
                        <div class="col-md-8 d-flex justify-content-center align-items-center">
                            <input
                                type="text"
                                name="keyword"
                                class="form-control border-0 me-2"
                                placeholder="Cari Pekerjaan..." />
                            <button type="submit" class="btn btn-dark ms-2">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Search End -->


        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h2 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Kategori Pekerjaan</h2>

                <!-- Carousel Start -->
                <div id="categoryCarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <!-- @foreach($categories->chunk(4) as $chunk)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}"> -->
                            <div class="row g-4">
                                @foreach($categories as $category)
                                <div class="col-lg-3 col-sm-6 mb-4">
                                    <a href="{{ route('frontend.category', $category->slug) }}" class="card text-center custom-card">
                                        <img src="{{ Storage::url($category->icon) }}" class="card-img-top" alt="{{ $category->name }} icon" style="width: 100px; height: 100px; margin: auto;">
                                        <div class="card-body">
                                            <h6 class="card-title mb-3">{{ $category->name }}</h6>
                                            <p class="card-text mb-0">{{ $category->jobs->count() }} jobs</p>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
                        <i class="fas fa-chevron-left"></i>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
                        <i class="fas fa-chevron-right"></i>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- Carousel End -->
            </div>
        </div>


        <!-- Rekomendasi Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h2 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s" style="font-family: 'Montserrat', sans-serif;">Rekomendasi Lowongan</h2>
                <div class="row g-3">
                    @forelse($jobs as $job)
                    <div class="col-md-6 col-lg-4 wow animate__animated animate__fadeInUp" data-wow-delay="0.1s">
                        <div class="card border border-secondary shadow-sm h-100 position-relative" style="border-radius: 10px; padding: 10px;">
                            <!-- Company Logo -->
                            <img src="{{ Storage::url($job->company->logo) }}" class="card-img-top" alt="{{ $job->company->name }} logo" style="height: 150px; object-fit: cover; border-top-left-radius: 10px; border-top-right-radius: 10px;">

                            <!-- Status Badge -->
                            @if(!$job->is_open)
                            <div class="badge bg-danger text-white position-absolute mt-2" style="top: 10px; right: 10px; border-radius: 10px; padding: 5px 10px; font-size: 0.75rem;">
                                Ditutup
                            </div>
                            @endif

                            <!-- Card Body -->
                            <div class="card-body d-flex flex-column border-top" style="padding: 10px; font-family: 'Sacramento', sans-serif;">
                                <!-- Company and Job Title -->
                                <h3 class="card-title mb-2" style="font-size: 1rem; font-weight: 500; color: #333;">Dibutuhkan</h3>
                                <h6 class="card-subtitle mb-3" style="font-size: 1.5rem; font-weight: 700; color: #000; font-family: 'Montserrat', sans-serif;">{{ $job->name }}</h6>

                                <!-- Job Details -->
                                <p class="card-text mb-2" style="font-size: 1rem; line-height: 1.5;">
                                    <img src="{{ asset('assets/icons/crown-orange.svg') }}" class="me-2" alt="Skill Icon" style="width: 20px;">
                                    {{ $job->company->name }}<br>
                                    <img src="{{ asset('assets/icons/lock.svg') }}" class="me-2 " alt="Education Icon" style="width: 20px;">
                                    {{ $job->education ?? 'N/A' }}<br>
                                    <img src="{{ asset('assets/icons/location-purple.svg') }}" class="me-2 " alt="Location Icon" style="width: 20px;">
                                    {{ $job->location }}<br>
                                    <img src="{{ asset('assets/icons/moneys-cyan.svg') }}" class="me-2 " alt="Salary Icon" style="width: 20px;">
                                    Rp {{ number_format($job->salary, 0, ',', '.') }}/bulan<br>
                                </p>

                                <!-- Posted Date -->
                                <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                    <small>Diposting: {{ $job->created_at->locale('id')->diffForHumans() }}</small>
                                </p>

                                <!-- Buttons -->
                                <div class="d-flex justify-content-between mt-auto">
                                    <a href="{{ route('frontend.details', $job->slug) }}" class="btn btn-outline-primary btn-sm">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-center">Belum ada data job tersedia</p>
                    @endforelse
                </div>


                <!-- Pagination Start -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $jobs->links() }} <!-- Laravel pagination links -->
                </div>
                <!-- Pagination End -->
            </div>
        </div>
        <!-- Rekomendasi End -->


        <!-- Pekerjaan Terbaru Start -->
        <div class="container-xxl py-5">
            <div class="container mt-4">
                <h2 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s" style="font-family: 'Montserrat', sans-serif;">Lowongan Terbaru</h2>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            @forelse($latestJobs as $job)
                            <div class="card border border-secondary shadow-sm h-100 position-relative" style="border-radius: 10px; padding: 10px;">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="{{ Storage::url($job->company->logo) }}" alt="{{ $job->company->name }} logo" style="width: 80px; height: 80px;">

                                        @if(!$job->is_open)
                                        <div class="badge bg-danger text-white position-absolute" style="top: 10px; right: 10px; border-radius: 10px; padding: 5px 10px; font-size: 0.75rem;">
                                            Ditutup
                                        </div>
                                        @endif

                                        <div class="text-start ps-4">
                                            <h5 class="mb-1 text-primary" style="font-family: 'Sacramento', cursive;">{{ $job->company->name }}</h5>
                                            <h4 class="mb-2 text-dark" style="font-size: 1.1rem; font-family: 'Montserrat', sans-serif;">{{ $job->name }}</h4>
                                            <div class="d-flex flex-wrap align-items-center">
                                                <span class="text-truncate me-3 d-flex align-items-center">
                                                    <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $job->location }}
                                                </span>
                                                <span class="text-truncate me-3 d-flex align-items-center">
                                                    <i class="far fa-clock text-primary me-2"></i>{{ $job->type }}
                                                </span>
                                                <span class="text-truncate me-3 d-flex align-items-center">
                                                    <i class="far fa-money-bill-alt text-primary me-2"></i>Rp {{ number_format($job->salary, 0, ',', '.') }}/bulan
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end">
                                        <div class="d-flex mt-auto">
                                            <a class="btn btn-primary" href="{{ route('frontend.details', $job->slug) }}">Details</a>
                                        </div>
                                    </div>

                                </div>
                                <small class="text-truncate text-end d-block mt-4">
                                    <i class="far fa-calendar-alt text-primary me-2"></i>Diposting: {{ $job->created_at->locale('id')->diffForHumans() }}
                                </small>

                            </div>

                            @empty
                            <p class="text-center">Belum ada data lowongan yang tersedia</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pekerjaan Terbaru End -->

        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Company</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contact</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center mx-auto mb-3 mb-md-0">
                            &copy; <a class="border-bottom"></a>2024 Akarindo
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Chat Button -->
        <a href="#" class="btn btn-lg btn-success btn-lg-square position-fixed chat-button" id="chatBtn">
            <i class="bi bi-chat-dots"></i>
        </a>

        <!-- Chat Box -->
        <div class="chat-box position-fixed d-none" id="chatBox">
            <div class="chat-header bg-success text-white p-3">
                <h5 class="m-0">Chat with Us</h5>
            </div>
            <div class="chat-body p-3">
                <p>Hello! How can we help you?</p>
                <!-- Add more chat bubbles as needed -->
            </div>
            <div class="chat-footer p-3">
                <input type="text" class="form-control" placeholder="Type a message...">
            </div>
        </div>

    </div>
    </div>
</body>
@endsection


@push('after-scripts')
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>


@endpush