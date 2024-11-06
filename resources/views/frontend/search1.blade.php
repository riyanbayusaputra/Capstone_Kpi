@extends('../layouts.master1')

@section('content')

<body class="font-poppins text-[#0E0140] pb-[100px] overflow-x-hidden bg-white">

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow sticky-top p-0">
        <div class="container-fluid"> <!-- Tambahkan container-fluid untuk memberikan jarak di sisi kiri dan kanan -->
            <a href="{{ route('frontend.index') }}" class="navbar-brand d-flex align-items-center py-0 px-4 px-lg-5">
                <img src="{{ asset('assets/logos/job-hub.png') }}" alt="AyoKerja.co Logo" class="img-fluid" style="max-height: 50px;">
            </a>

            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav d-flex justify-content-center w-100">
                    <a href="{{ route('frontend.index') }}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Layanan</a>
                        <div class="dropdown-menu rounded-0 m-0 bg-dark">
                            <a href="#" class="dropdown-item text-light">Course</a>
                            <a href="{{ route('frontend.webinar') }}" class="dropdown-item text-light">Webinar</a>
                            <a href="{{ route('psikotes.index')}}" class="dropdown-item text-light">Psikotes</a>
                            <a href="{{ route('tmb.index') }}" class="dropdown-item text-light">Test Minat Bakat</a>
                        </div>
                    </div>
                    <a href="{{ route('informasi-pribadi.index') }}" class="nav-item nav-link">CV ats</a>
                    <a href="{{ route('forum.index') }}" class="nav-item nav-link">Forum Diskusi</a>
                </div>
                @guest
                <div class="d-flex align-items-center gap-2 me-4 mb-3 mb-lg-0"> <!-- Tambahkan kelas mt-3 untuk jarak vertikal -->
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
        </div> <!-- Penutup div container-fluid -->
    </nav>
    <!-- Navbar End -->


    <!-- Header Section -->
    <header class="container-xxl text-center mt-[150px] mb-[40px] p-5 rounded" style="background: linear-gradient(to right, #e3f2fd, #bbdefb); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);"> <!-- Gradient background and box shadow -->
        <h2 class="font-black text-[40px] text-dark mb-3">Pencarian: {{ ucfirst($keyword) }}</h2> <!-- Increased font size and added margin -->
    </header>

    <!-- Job Listings Section -->
    <section id="Result" class="container-xxl mt-5">
        <div class="container my-5">
            <div class="row g-4">
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
                            <ul class="list-unstyled mb-2" style="font-size: 1rem; line-height: 1.5;">
                                <li class="mb-2 d-flex align-items-center">
                                    <img src="{{ asset('assets/icons/gedung.png') }}" class="me-2" alt="Skill Icon" style="width: 20px;">
                                    <span>{{ $job->company->name }}</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <img src="{{ asset('assets/icons/pendidikan.png') }}" class="me-2" alt="Education Icon" style="width: 20px;">
                                    <span>{{ $job->education ?? 'N/A' }}</span>
                                </li>
                                <li class="mb-2 d-flex align-items-center">
                                    <img src="{{ asset('assets/icons/lokasi.png') }}" class="me-2" alt="Location Icon" style="width: 20px;">
                                    <span>{{ $job->location }}</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <img src="{{ asset('assets/icons/uang.png') }}" class="me-2" alt="Salary Icon" style="width: 20px;">
                                    <span>Rp {{ number_format($job->salary, 0, ',', '.') }}/bulan</span>
                                </li>
                            </ul>

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
                <p class="text-center">Belum ada data pekerjaan tersedia</p>
                @endforelse
            </div>
        </div>

        {{ $jobs->links() }}
    </section>

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
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


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