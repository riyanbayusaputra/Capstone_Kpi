@extends('../layouts.master1')

@section('content')

@section('meta')

<meta property="og:locale" content="id_ID" />

<meta property="og:title" content="Rekomendasi Lowongan Kerja di Semarang September 2024 - ayokerja.co.id" />
<meta property="og:description" content="Rekomendasi lowongan kerja di Semarang untuk beragam profesi dan minimal pendidikan SMA / SMK, D3, dan S1." />
<meta property="og:url" content="https://www.testing.ayokerja.co.id/" />
<meta property="og:site_name" content="ayokerja.co.id" />
<meta property="og:image" content="{{ asset('assets/logos/job-kotak.png') }}" />



@endsection


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


        <!-- Pekerjaan Terbaru Start -->
        <div id="latest-jobs" class="container-xxl py-3">
            <div class="container mt-4">
                <!-- Menampilkan teks Hasil Pencarian lebih ke atas -->
                @if(request()->has('keyword') || request()->has('location') || request()->has('education') || request()->has('experience'))
                <h2 class="text-left mb-5 wow fadeInUp" data-wow-delay="0.1s">Hasil Pencarian</h2>
                @else
                <h2 class="text-left mb-5 wow fadeInUp text-center" data-wow-delay="0.1s">Lowongan Rekomendasi</h2>
                @endif

                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            @forelse($rekomendJobs as $job)
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

<!-- Template Javascript -->
<script src="js/main.js"></script>


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


<script>
    // Function to get the current month name
    function getCurrentMonth() {
        const months = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        const now = new Date();
        return months[now.getMonth()];
    }

    // Set the current month in the HTML
    document.getElementById('currentMonth').textContent = getCurrentMonth();
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


@endpush