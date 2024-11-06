@extends('../layouts.master1')

@section('content')

@section('meta')

<meta property="og:locale" content="id_ID" />
<meta property="og:type" content="website" />
<meta property="og:title" content="JOBHUB - Lowongan Kerja " />
<meta property="og:description" content="Loker terbaru dengan beragam pilihan profesi. Informasi lowongan kerja untuk berbagai tingkat pendidikan." />
<meta property="og:url" content="https://www.testing.ayokerja.co.id/" />
<meta property="og:site_name" content="ayokerja.co.id" />
<meta property="og:image" content="{{ asset('assets/logos/job-kotak.png') }}" />

@endsection

</style>

<body>
    <div class="container-xxl bg-white p-0">

        {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}

        <x-nav />

        <div class="portal" style="background-image: url('assets/backgrounds/heading.png'); background-color: #ADD8E6; background-blend-mode: overlay; background-size: cover; background-position: center; background-repeat: no-repeat; height: 300px; position: relative;">
            <div class="container text-center" style="position: absolute; top: 10%; left: 50%; transform: translate(-50%, 0);">
                <!-- Tambahkan logo di sini -->
                <img src="{{ asset('assets/logos/job-hub.png') }}" alt="Logo" style="width: 150px; height: auto; margin-bottom: 10px; border-radius: 10px;">
                <h1 id="portalTitle" class="text-dark">Portal Lowongan Kerja</h1>
                <p id="portalDescription" class="text-dark">Temukan Lowongan Kerja Terbaru dari Seluruh Wilayah di Jawa Tengah</p>
            </div>
        </div>



        <!-- Search Form -->
        <div class="container-xxl search-form-container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="card1 p-4 border shadow-lg h-100 position-relative" style="border-radius: 15px; background-color: white;">
                        <form id="jobSearchForm" action="{{ route('frontend.search') }}#latest-jobs" method="GET">
                            <div class="row g-3 align-items-center">
                                <!-- Input search -->
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Cari disini..">
                                </div>

                                <!-- Dropdown for Location -->
                                <div class="col-lg-2 col-md-6 col-sm-12">
                                    <select id="location" name="location" class="form-select" style="border: 1px solid #ced4da;">
                                        <option value="" disabled selected hidden>Pilih Lokasi</option>
                                        <option value="Banjarnegara">Banjarnegara</option>
                                        <option value="Banyumas">Banyumas</option>
                                        <option value="Batang">Batang</option>
                                        <option value="Blora">Blora</option>
                                        <option value="Boyolali">Boyolali</option>
                                        <option value="Brebes">Brebes</option>
                                        <option value="Cilacap">Cilacap</option>
                                        <option value="Demak">Demak</option>
                                        <option value="Jepara">Jepara</option>
                                        <option value="Karanganyar">Karanganyar</option>
                                        <option value="Kebumen">Kebumen</option>
                                        <option value="Kendal">Kendal</option>
                                        <option value="Klaten">Klaten</option>
                                        <option value="Kudus">Kudus</option>
                                        <option value="Magelang">Magelang</option>
                                        <option value="Pekalongan">Pekalongan</option>
                                        <option value="Pemalang">Pemalang</option>
                                        <option value="Purbalingga">Purbalingga</option>
                                        <option value="Purworejo">Purworejo</option>
                                        <option value="Salatiga">Salatiga</option>
                                        <option value="Semarang">Semarang</option>
                                        <option value="Sragen">Sragen</option>
                                        <option value="Solo">Solo</option>
                                        <option value="Sukoharjo">Sukoharjo</option>
                                        <option value="Tegal">Tegal</option>
                                        <option value="Temanggung">Temanggung</option>
                                        <option value="Wonosobo">Wonosobo</option>
                                    </select>
                                </div>

                                <!-- Dropdown for Education -->
                                <div class="col-lg-2 col-md-6 col-sm-12">
                                    <select id="education" name="education" class="form-select" style="border-radius: 10px; border: 1px solid #ced4da;">
                                        <option value="" disabled selected hidden>Lulusan</option>

                                        <option value="SD - SMP">SD - SMP</option>
                                        <option value="SMA / SMK">SMA / SMK</option>
                                        <option value="D1 - D3">D1 - D3</option>
                                        <option value="S1 / D4">S1 / D4</option>
                                        <option value="S2 / Profesi">S2 / Profesi</option>
                                    </select>
                                </div>
                                <!-- Dropdown for Experience -->

                                <!-- Dropdown for Type (Single Select) -->
                                <div class="col-lg-3 col-md-6 col-sm-12 d-flex flex-row">
                                    <div class="form-check me-3">
                                        <input class="form-check-input custom-radio me-1" type="radio" name="type" id="typeFormal" value="Formal">
                                        <label class="form-check-label" for="typeFormal">
                                            Formal
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input custom-radio me-1" type="radio" name="type" id="typeNonFormal" value="Non-Formal">
                                        <label class="form-check-label" for="typeNonFormal">
                                            Non-Formal
                                        </label>
                                    </div>
                                </div>


                                <!-- Search button -->
                                <div class="col-lg-2 col-md-6 col-sm-12 d-flex justify-content-end">
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

        <!-- Rekomendasi Start -->
        <div class="container-xxl py-3">
            <div class="container">
                <h2 class="text-center mb-4 wow fadeInUp" data-wow-delay="0.1s" style="font-family: 'Montserrat', sans-serif;">
                    Rekomendasi Lowongan</h2>

                <!-- Swiper Container -->
                <div class="swiper mySwiper" style="padding-top: 20px; padding-bottom: 20px;">
                    <div class="swiper-wrapper">
                        @forelse($jobs as $job)
                        <div class="swiper-slide">
                            <!-- Full card with hover effect -->
                            <div class="card-loker shadow-sm h-100 position-relative job-card"
                                style="border-radius: 10px; padding: 10px; border: 1px solid #f49721; height: 100%; transition: all 0.3s ease;">
                                <!-- Company Logo -->
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset($job->company->logo) }}" class="card-img-top"
                                        alt="{{ $job->company->name }} logo"
                                        style="height: 80px; width: auto; object-fit: contain; margin-top: 10px; margin-bottom: 10px;">
                                </div>

                                <!-- Status Badge -->
                                @if(!$job->is_open)
                                <div class="badge bg-danger text-white position-absolute mt-2"
                                    style="top: 10px; right: 10px; border-radius: 10px; padding: 5px 10px; font-size: 0.75rem;">
                                    DITUTUP
                                </div>
                                @endif

                                <!-- Card Body -->
                                <div class="card-body d-flex flex-column border-top"
                                    style="padding: 8px; font-family: 'Sacramento', sans-serif;">
                                    <h3 class="card-title mb-2" style="font-size: 0.9rem; font-weight: 500; color: #333;">
                                        Dibutuhkan</h3>
                                    <h6 class="card-subtitle mb-3"
                                        style="font-size: 1rem; font-weight: 600; color: #000; font-family: 'Montserrat', sans-serif;">
                                        {{ $job->name }}
                                    </h6>

                                    <ul class="list-unstyled mb-2" style="font-size: 0.8rem; line-height: 1.3;">
                                        <li class="mb-1 d-flex align-items-center text-truncate">
                                            <i class="bi bi-building me-2" style="font-size: 20px;"></i>
                                            <span class="job-title">{{ $job->company->name }}</span>
                                        </li>
                                        <li class="mb-1 d-flex align-items-center">
                                            <i class="bi bi-mortarboard me-2" style="font-size: 20px;"></i>
                                            <span>{{ $job->education ?? 'N/A' }}</span>
                                        </li>
                                        <li class="mb-1 d-flex align-items-center">
                                            <i class="bi bi-geo-alt me-2" style="font-size: 20px;"></i>
                                            <span>{{ $job->location }}</span>
                                        </li>

                                    </ul>

                                 
                                    <!-- Verified Label -->
                                    <p class="verified-icon text-muted" style="font-size: 0.8rem; color: #3897f0;">
                                        <small>
                                            <i class="bi bi-check-circle-fill" style="font-size: 0.8rem; color: #3897f0;"></i>
                                            {{ $job->verified }}
                                        </small>
                                    </p>



                                    {{-- <!-- Posted Date -->
                                    <p class="text-muted" style="font-size: 0.75rem;">
                                        <small>
                                            <i class="bi bi-clock me-1"></i> <!-- Clock Icon -->
                                            {{ $job->created_at->locale('id')->diffForHumans() }}
                                        </small>
                                    </p> --}}
                                    

                                    <!-- Button -->
                                    <div class="d-flex justify-content-between mt-auto">
                                        <a href="{{ route('frontend.details', $job->slug) }}"
                                            class="btn btn-outline-primary btn-sm"
                                            style="color: #f49721; border-color: #f49721; border-radius: 5px; transition: all 0.3s ease;"
                                            onmouseover="this.style.backgroundColor='#f49721'; this.style.color='white';"
                                            onmouseout="this.style.backgroundColor='transparent'; this.style.color='#f49721';">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p class="text-center">Belum ada data pekerjaan tersedia</p>
                        @endforelse
                    </div>

                    <!-- Add Pagination -->
                    <!-- <div class="swiper-pagination"></div> -->
                    <!-- Add Navigation -->
                    <!-- <div class="swiper-button-next custom-swiper-button">

                    </div>
                    <div class="swiper-button-prev custom-swiper-button">

                    </div> -->
                </div>
            </div>
        </div>


        <!-- Rekomendasi End -->
        <div class="text-center">
            <a href="{{ route('frontend.rekomendasi') }}" class="rekomendasi-link">
                Rekomendasi Loker Lainnya >>
            </a>
        </div>


        <!-- Pekerjaan Terbaru Start -->
        <div id="latest-jobs" class="container-xxl py-3">
            <div class="container mt-4">
                <!-- Menampilkan teks Hasil Pencarian lebih ke atas -->
                @php
                $keyword = request()->input('keyword');
                $location = request()->input('location');
                $education = request()->input('education');
                $experience = request()->input('experience');
                $type = request()->input('type')
                @endphp

                <h2 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                    @if($keyword || $location || $education || $experience || $type)
                    Hasil Pencarian untuk
                    @if($keyword)
                    "<strong>{{ $keyword }}</strong>"
                    @endif
                    @if($location)
                    @if($keyword) dan @endif
                    "<strong>{{ $location }}</strong>"
                    @endif
                    @if($education)
                    @if($keyword || $location) dan @endif
                    "<strong>{{ $education }}</strong>"
                    @endif
                    @if($experience)
                    @if($keyword || $location || $education) dan @endif
                    "<strong>{{ $experience }}</strong>"
                    @endif
                    @if($type)
                    @if($keyword || $location || $education || $experience) dan @endif
                    "<strong>{{ $type }}</strong>"
                    @endif
                    @else
                    Lowongan Terbaru
                    @endif
                </h2>


                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            @forelse($latestJobs as $job)
                            <div class="card shadow-sm h-100 position-relative mb-3" style="border-radius: 10px; padding: 10px; border: 1px solid #f49721;">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex flex-column flex-md-row align-items-center text-center text-md-start">
                                        <img class="img-fluid border rounded mx-auto mx-md-0"
                                            src="{{ asset($job->company->logo) }}"
                                            alt="{{ $job->company->name }} logo"
                                            style="width: 100px; height: 100px; object-fit: cover;">

                                        @if(!$job->is_open)
                                        <div class="badge bg-danger text-white position-absolute" style="top: 10px; right: 10px; border-radius: 10px; padding: 5px 10px; font-size: 0.75rem;">
                                            DITUTUP
                                        </div>
                                        @endif

                                        <div class="ps-md-4 mt-3 mt-md-0">
                                            <!-- HTML untuk menampilkan nama perusahaan dan ikon centang -->
                                            <h5 class="mb-1 text-dark" style="font-size: 1.3rem;">
                                                {{ $job->company->name }}
                                            </h5>
                                            <h4 class="mb-2 text-dark" style="font-size: 1.1rem;">{{ $job->name }}</h4>
                                            <div class="d-flex flex-wrap justify-content-center justify-content-md-start align-items-center">
                                                <span class="text-truncate me-3 d-flex align-items-center">
                                                    <i class="bi bi-geo-alt me-2"></i>{{ $job->location }}
                                                </span>
                                                <span class="text-truncate me-3 d-flex align-items-center">
                                                    <i class="bi bi-mortarboard me-2"></i>{{ $job->education ?? 'N/A' }}
                                                </span>
                                                <span class="text-truncate me-3 d-flex align-items-center">
                                                    <i class="bi bi-briefcase me-2"></i>{{ $job->experience ?? 'N/A' }}
                                                </span>
                                                <span class="text-truncate me-3 d-flex align-items-center">
                                                    <i class="bi bi-person-lines-fill me-2"></i>{{ $job->type }}
                                                </span>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-end text-end mt-3 mt-md-0">
                                        <div class="d-flex mt-auto ms-auto">
                                            <a class="btn" href="{{ route('frontend.details', $job->slug) }}" style="background-color: #f49721; color: white; border-radius: 5px;">
                                                Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-4">
                                    <!-- Status terverifikasi -->
                                    <small class="verified-icon d-flex align-items-center text-truncate" 
                                           style="flex: 1; max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        <i class="bi bi-check-circle-fill me-1" style="color: #3897f0;"></i>
                                        {{ $job->verified }}
                                    </small>
                                
                                    <!-- Tanggal postingan -->
                                    <small class="text-truncate text-end" style="flex-shrink: 0;">
                                        <i class="bi bi-clock me-1"></i>
                                        {{ $job->created_at->locale('id')->diffForHumans() }}
                                    </small>
                                </div>
                                
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
<!-- JS Swiper -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>


<!-- Include Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000, // Delay between transitions (in milliseconds)
            disableOnInteraction: false, // Autoplay won't stop when user interacts with the slider
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 30,
            },
        }
    });
</script>

<!-- <script>
    // Function for smooth scrolling to the target section
    document.getElementById('jobSearchForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting right away

        // Scroll to the latest-jobs section smoothly
        document.querySelector('#latest-jobs').scrollIntoView({
            behavior: 'smooth'
        });

        // Submit the form after a slight delay to allow the scroll
        setTimeout(() => {
            this.submit(); // Submit the form after delay
        }, 800); // Adjust delay as necessary (800ms = 0.8 seconds)
    });
</script> -->


<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Initialize Choices.js for the search input
        const searchInput = new Choices('input[name="keyword"]', {
            searchEnabled: true, // Enable search functionality
            placeholder: true, // Enable placeholder functionality
            placeholderValue: 'Cari disini..', // Custom placeholder text for search
            removeItemButton: false, // Disable item removal for input
            duplicateItemsAllowed: false, // Prevent duplicate search terms
            addItems: true, // Allow adding new search terms
            noChoicesText: 'Tidak ada hasil' // Custom message when no results found
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Choices.js for the 'Education' dropdown
        const educationSelect = new Choices('#education', {
            searchEnabled: true, // Enable search within the dropdown
            placeholder: true, // Enable placeholder functionality
            placeholderValue: 'Lulusan', // Teks placeholder kustom
            removeItemButton: true, // Menonaktifkan tombol hapus
            itemSelectText: '', // Menghilangkan teks "Press to select"
            shouldSort: false, // Menjaga urutan opsi tetap seperti HTML
            searchPlaceholderValue: 'Cari lulusan...',
        });

        // Initialize Choices.js for the 'Location' dropdown
        const locationSelect = new Choices('#location', {
            searchEnabled: true, // Mengaktifkan pencarian di dropdown
            placeholder: true, // Mengaktifkan placeholder
            placeholderValue: 'Pilih Lokasi', // Teks placeholder kustom
            removeItemButton: true, // Menonaktifkan tombol hapus
            itemSelectText: '', // Menghilangkan teks "Press to select"
            shouldSort: false, // Menjaga urutan opsi tetap seperti HTML
            searchPlaceholderValue: 'Cari lokasi...',
        });

        // Tambahkan CSS class pada dropdown untuk efek pemotongan teks
        document.querySelector('#location').classList.add('select-container');

        // Initialize Choices.js for the 'Type' dropdown
        const typeSelect = new Choices('#type', {
            searchEnabled: true, // Mengaktifkan pencarian di dropdown
            placeholder: true, // Mengaktifkan placeholder
            placeholderValue: 'Tipe Pekerjaan', // Teks placeholder kustom
            removeItemButton: true, // Menonaktifkan tombol hapus
            itemSelectText: '', // Menghilangkan teks "Press to select"
            shouldSort: false, // Menjaga urutan opsi tetap seperti HTML
            searchPlaceholderValue: 'Cari tipe pekerjaan...',
        });

        // Tambahkan CSS class pada dropdown untuk efek pemotongan teks
        document.querySelector('#type').classList.add('select-container');
    });
</script>


<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const verifiedIcons = document.querySelectorAll('.verified-icon');

        verifiedIcons.forEach(icon => {
            icon.addEventListener('click', function() {
                Swal.fire({
                    title: 'Informasi',
                    text: 'Loker ini dari tim Jobhub.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            });
        });
    });
</script>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const verifiedIcon = document.getElementById('verified-icon-rekomendasi');

        verifiedIcon.addEventListener('click', function() {
            Swal.fire({
                title: 'Informasi',
                text: 'Loker ini dari tim Jobhub.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        });
    });
</script>


<!-- <script>
    function getCurrentMonth() {
        const months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        const now = new Date();
        return months[now.getMonth()];
    }

    document.getElementById('currentMonth').textContent = getCurrentMonth();
</script> -->

<!-- <script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 4,
            },
        },
    });
</script> -->


@endpush