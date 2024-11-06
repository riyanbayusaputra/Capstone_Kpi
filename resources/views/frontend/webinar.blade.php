@extends('../layouts.master1')
@section('content')

<body>
    <div class="container-xxl bg-white p-0">

        <x-nav />

        <!-- New Career Section Start -->
        <div class="portal" style="background-image: url('assets/backgrounds/heading.png'); background-color: #ADD8E6; background-blend-mode: overlay; background-size: cover; background-position: center; background-repeat: no-repeat;">
            <div class="container text-center">
                <h1 id="portalTitle" class="text-dark">Webinar</h1>
                <p id="portalDescription" class="text-dark">Tingkatkan Keterampilan Anda! Bergabunglah dengan Webinar
                    Kami dan Siapkan Diri untuk Karir Impian Anda!.</p>
            </div>
        </div>
        <!-- New Career Section End -->

        <!-- Search Form -->
        <div class="container search-form-container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="card1 p-4 border shadow-lg h-100 position-relative" style="border-radius: 15px; background-color: white;">
                        <form action="" method="GET">
                            <div class="row g-3 align-items-center">
                                <!-- Input search -->
                                <div class="col-lg-10 col-md-8 col-12">
                                    <input type="text" id="search" name="search" class="form-control search-input" placeholder="Cari webinar disini.." style="border-radius: 10px;">
                                </div>

                                <!-- Search button -->
                                <div class="col-lg-2 col-md-4 col-12">
                                    <button type="submit" class="btn w-100" style="background-color: #f49721; border-color: #f49721; border-radius: 10px;">
                                        <i class="fa fa-search text-white"></i> <span class="text-white">Cari</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search Form End -->


        <!-- Webinar Start -->
        <div class="container-xxl py-5">
            <div class="container">
                @if ($webinars->isEmpty())
                <p class="text-center mb-5 wow fadeInUp">Tidak ada webinar yang ditemukan.</p>
                @else

                <!-- Search Form -->
                <!-- <div class="search-container mb-5 text-center wow fadeInUp" data-wow-delay="0.3s">
                    <form action="" method="GET" class="d-flex justify-content-center">
                        <input type="text" name="search" id="search" class="form-control search-input" placeholder="Cari Webinar..." aria-label="Search">
                        <button type="submit" class="btn btn-primary ms-2">Cari</button>
                    </form>
                </div> -->
                <!-- Search Form -->


                @foreach($webinars as $webinar)
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <!-- Menggunakan struktur card -->
                            <div class="card shadow-sm h-100 position-relative mb-3" style="border-radius: 10px; padding: 10px; border: 1px solid #f49721;">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex flex-column flex-md-row align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded mb-3 mb-md-0" src="{{ asset('images/' . $webinar->icon) }}" alt="{{ $webinar->name }}" style="width: 200px; height: 200px;">
                                        <div class="text-start ps-0 ps-md-4">
                                            <h5 class="mb-3">{{ $webinar->name }}</h5>
                                            <span class="d-block mb-1"><i class="bi bi-calendar me-2"></i>Mulai : {{ \Carbon\Carbon::parse($webinar->tanggal_mulai)->translatedFormat('d F Y H:i') }}</span>
                                            <span class="d-block mb-1"><i class="bi bi-calendar me-2"></i>Selesai : {{ \Carbon\Carbon::parse($webinar->tanggal_selesai)->translatedFormat('d F Y H:i') }}</span>
                                            <span class="d-block"><i class="bi bi-person me-2"></i>Peserta : {{ $webinar->peserta }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end">
                                        <div class="d-flex mt-auto">
                                            <a class="btn" style="background-color: #f49721; color: white; border-radius: 5px;" href="{{ route('frontend.details_webinar', ['id' => $webinar->id]) }}">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Akhir dari struktur card -->
                        </div>
                    </div>
                </div>
                @endforeach


                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" style="font-size: 0.875rem; margin: 0;">
                            <!-- Previous Button -->
                            <li class="page-item" style="margin: 0 0.1rem;">
                                @if ($webinars->onFirstPage())
                                <span class="page-link" style="padding: 0.25rem 0.5rem; cursor: not-allowed;" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </span>
                                @else
                                <a class="page-link" href="{{ $webinars->previousPageUrl() }}" style="padding: 0.25rem 0.5rem;" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                                @endif
                            </li>

                            <!-- Page Numbers -->
                            @foreach ($webinars->links()->elements[0] as $page => $url)
                            <li class="page-item {{ $page == $webinars->currentPage() ? 'active' : '' }}" style="margin: 0 0.1rem;">
                                @if ($page == $webinars->currentPage())
                                <span class="page-link" style="padding: 0.25rem 0.5rem; background-color: #FFA500; color: white; border-color: #FFA500;">
                                    {{ $page }}
                                </span>
                                @else
                                <a class="page-link" href="{{ $url }}" style="padding: 0.25rem 0.5rem;">
                                    {{ $page }}
                                </a>
                                @endif
                            </li>
                            @endforeach

                            <!-- Next Button -->
                            <li class="page-item" style="margin: 0 0.1rem;">
                                @if ($webinars->hasMorePages())
                                <a class="page-link" href="{{ $webinars->nextPageUrl() }}" style="padding: 0.25rem 0.5rem;" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                                @else
                                <span class="page-link" style="padding: 0.25rem 0.5rem; cursor: not-allowed;" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </span>
                                @endif
                            </li>
                        </ul>
                    </nav>
                </div>
                @endif
            </div>
        </div>
        <!-- Webinar End -->

        <!-- Footer Start -->
        <!-- <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-12 text-left">
                        <h5 class="text-white mb-4">About Us</h5>

                        <div class="d-flex flex-wrap">
                            @forelse ($links as $link)
                            <a class="text-white-50 mx-2" href="{{ route('show.content', ['link_laman' => $link->title]) }}" target="_blank">{{ $link->title }}</a>
                            @if (!$loop->last)
                            <span class="text-white-50 mx-2">/</span>
                            @endif
                            @empty
                            <p class="text-white-50">No links available</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center mx-auto mb-3 mb-md-0">
                            &copy; <a class="border-bottom"></a>2024 JobHub
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Footer End -->


        <!-- Chat Button -->
        <!-- <a href="#" class="btn btn-lg btn-success btn-lg-square position-fixed chat-button" id="chatBtn">
            <i class="bi bi-chat-dots"></i>
        </a> -->

        <!-- Chat Box -->
        <!-- <div class="chat-box position-fixed d-none" id="chatBox">
            <div class="chat-header bg-success text-white p-3">
                <h5 class="m-0 text-white">Chat with Us</h5>
            </div>
            <div class="chat-body p-3">
                <p>Hello! How can we help you?</p>
            </div>
            <div class="chat-footer p-3">
                <input type="text" class="form-control" placeholder="Type a message...">
            </div>
        </div> -->
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