<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow sticky-top p-0">
    <div class="container-fluid"> <!-- Tambahkan container-fluid untuk memberikan jarak di sisi kiri dan kanan -->
        <a href="{{ route('frontend.index') }}" class="navbar-brand d-flex align-items-center py-0 px-4 px-lg-5">
            <img src="{{ asset('assets/logos/job-hub.png') }}" alt="AyoKerja.co Logo" class="img-fluid" style="max-height: 60px;">
        </a>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" style="background-color: #f49721; border-color: #f49721;">
            <i class="bi bi-arrow-up"></i>
        </a>


        <!-- Bottom Navigation -->
        <nav class="bottom-nav">
            <a href="javascript:history.back()" class="nav-item">
                <svg class="icon" viewBox="0 0 24 24">
                    <!-- Back Icon -->
                    <path d="M19 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H19v-2z" />
                </svg>
                <span>Back</span>
            </a>
            <a href="/" class="nav-item">
                <svg class="icon" viewBox="0 0 24 24">
                    <!-- Home Icon -->
                    <path d="M12 3l8 8h-3v9h-4v-6h-2v6H7v-9H4l8-8z" />
                </svg>
                <span>Home</span>
            </a>
            <a href="{{ route('frontend.rekomendasi') }}" class="nav-item">
                <svg class="icon" viewBox="0 0 24 24">
                    <!-- Favorite Icon -->
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
                <span>Favorite</span>
            </a>
        </nav>

        <!-- CSS -->
        <style>
            .bottom-nav {
                display: flex;
                justify-content: space-around;
                align-items: center;
                background-color: #333;
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                height: 70px;
                padding: 10px 0;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.15);
                z-index: 1000;
            }

            .nav-item {
                text-align: center;
                color: white;
                padding: 5px;
                font-size: 12px;
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .nav-item:hover {
                color: #ffd700;
            }

            .icon {
                width: 28px;
                height: 28px;
                fill: white;
                transition: fill 0.3s ease;
            }

            .nav-item:hover .icon {
                fill: #ffd700;
            }

            .nav-item span {
                display: block;
                margin-top: 3px;
                font-size: 10px;
            }

            /* Hide bottom nav on larger screens */
            @media (min-width: 768px) {
                .bottom-nav {
                    display: none;
                }
            }

            /* Default styling for desktop and larger screens */
            footer {
                margin-bottom: 0;
            }

            /* Apply extra margin in mobile view */
            @media (max-width: 767px) {
                footer {
                    margin-bottom: 40px;
                    /* Space for bottom navigation on mobile */
                }
            }

            /* Back to Top button */
            .back-to-top {
                position: fixed;
                bottom: 80px;
                /* Ensuring it is above the bottom-nav */
                right: 20px;
                z-index: 1000;
                /* Keep it above other content */
            }
        </style>


        <!-- <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <!-- <div class="collapse navbar-collapse" id="navbarCollapse"> -->
        <!-- <div class="navbar-nav d-flex justify-content-center w-100">
                <a href="" class="nav-item nav-link">Home</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Layanan</a>
                    <div class="dropdown-menu rounded-0 m-0 bg-dark">
                        <a href="#" class="dropdown-item text-light">Course</a>
                        <a href="" class="dropdown-item text-light">Webinar</a>
                        <a href=" class="dropdown-item text-light">Psikotes</a>
                        <a href=" class="dropdown-item text-light">Test Minat Bakat</a>
                    </div>
                </div>
                <a href=" class="nav-item nav-link">CV ats</a>
                <a href="" class="nav-item nav-link">Forum Diskusi</a>
            </div> -->
        <!-- @guest
                    <div class="d-flex align-items-center gap-2 me-4 mb-3 mb-lg-0">
                        <a href="" class="btn btn-outline-primary rounded-3 px-2 py-1">Login</a>
                        <a href="" class="btn btn-primary rounded-3 px-2 py-1">Register</a>
                    </div>
                    @endguest -->
        <!-- @auth
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
                    @endauth -->
        <!-- </div> -->
    </div> <!-- Penutup div container-fluid -->
</nav>
<!-- Navbar End -->