@extends('../layouts.master1')
@section('content')

@section('meta')
<meta property="og:locale" content="id_ID" />
<meta property="og:image" content="{{ asset($companyJob->company->logo) }}" />
<meta property="og:title" content="Lowongan Kerja {{ $companyJob->name }} di {{ $companyJob->company->name }} untuk wilayah {{  $companyJob->location  }}" />
<meta property="og:description" content="Informasi Lowongan Kerja: {{ Str::limit($companyJob->description, 150) }} Deskripsi Pekerjaan: {{ implode(', ', $companyJob->responsibilities->pluck('name')->toArray()) }}. Syarat Pekerjaan: {{ implode(', ', $companyJob->qualifications->pluck('name')->toArray()) }}. Gaji: {{ $companyJob->salary }} Lokasi: {{ $companyJob->location }}. Pendidikan: {{ $companyJob->education }}. Pengalaman: {{ $companyJob->experience }}. Keahlian: {{ $companyJob->skill_level }}." />

<meta property="og:url" content="https://www.testing.ayokerja.co.id/" />
<meta property="og:site_name" content="ayokerja.co.id" />


@endsection


<body>
    <div class="container-xxl bg-white p-0">

        <x-nav />

        <!-- <div class="portal" style="background-color: #343a40;">
            <div class="container text-center">
                <h1 id="portalTitle" class="text-white">Detail Pekerjaan</h1>
            </div>
        </div> -->


        <!-- Job Detail Start -->
<div class="container-xxl py-3 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row gy-5 gx-4">
            <!-- Job Details Section -->
            <div class="col-lg-8 col-md-12">
                <div class="card-loker shadow-sm h-100 position-relative mb-3" style="border-radius: 10px; padding: 10px; border: 1px solid #f49721;">
                    <div class="card-body p-4">
                        <!-- Company and Job Title Section -->
                        <div class="company-section d-flex align-items-center mb-4">
                            <img class="company-logo flex-shrink-0 img-fluid border" src="{{ asset($companyJob->company->logo) }}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                            <div class="text-start ps-md-4 text-center text-md-start">
                                <h3 class="mb-2" style="font-family: 'Montserrat', sans-serif; font-size: 1.3rem;">
                                    {{ $companyJob->company->name }}
                                </h3>
                                <div class="mb-2 position-relative">
                                    @if($companyJob->is_open)
                                        <span class="badge bg-primary rounded-pill" style="font-family: 'Montserrat', sans-serif;">membuka lowongan</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill" style="font-family: 'Montserrat', sans-serif;">Lowongan sudah ditutup</span>
                                    @endif
                                </div>
                                <h6 class="mb-2 fs-5 fw-semibold text-dark" style="font-family: 'Arial', sans-serif;">{{ $companyJob->name }}</h6>
                            </div>
                        </div>

                        <!-- Company Description -->
                        <h6 class="mb-3" style="font-family: 'Montserrat', sans-serif; font-size: 1.1rem;">Tentang Perusahaan</h6>
                        <p style="font-family: 'Montserrat', sans-serif; font-size: 0.9rem;">
                            {!! $companyJob->about !!}
                        </p>

                        <div style="border-bottom: 1px solid #dee2e6; margin: 1rem 0;"></div>

                        <!-- Job Description -->
                        <h6 class="mb-3" style="font-family: 'Montserrat', sans-serif; font-size: 1.1rem;">Deskripsi Pekerjaan</h6>
                        <ul class="list-group list-group-flush mb-4">
                            @foreach($companyJob->responsibilities as $responsibility)
                                <li class="list-group-item d-flex align-items-start" style="font-family: 'Montserrat', sans-serif; font-size: 0.9rem;">
                                    <i class="bi bi-check-circle-fill me-2"></i>{{ $responsibility->name }}
                                </li>
                            @endforeach
                        </ul>

                        <div style="border-bottom: 1px solid #dee2e6; margin: 1rem 0;"></div>

                        <!-- Job Requirements -->
                        <h6 class="mb-3" style="font-family: 'Montserrat', sans-serif; font-size: 1.1rem;">Syarat Pekerjaan</h6>
                        <ul class="list-group list-group-flush mb-4">
                            @foreach($companyJob->qualifications as $qualification)
                                <li class="list-group-item d-flex align-items-start" style="font-family: 'Montserrat', sans-serif; font-size: 0.9rem;">
                                    <i class="bi bi-check-circle-fill me-2"></i>{{ $qualification->name }}
                                </li>
                            @endforeach
                        </ul>

                        <div style="border-bottom: 1px solid #dee2e6; margin: 1rem 0;"></div>

                        <!-- Contact Information -->
                        <h6 class="mb-3" style="font-family: 'Montserrat', sans-serif; font-size: 1.1rem;">Informasi Kontak</h6>
                        <ul class="list-group list-group-flush mb-4">
                            <li class="list-group-item d-flex align-items-start" style="font-family: 'Montserrat', sans-serif; font-size: 0.9rem;">
                                <i class="bi bi-telephone me-2"></i>No Telepon:&nbsp;<span id="phone">{{ $companyJob->phone_number }}</span>
                                <button class="btn btn-sm ms-2 p-0" onclick="copyToClipboard('#phone')" style="border: none; background: none;">
                                    <i class="bi bi-clipboard-check" style="font-size: 12px;"></i>
                                </button>
                            </li>
                            @if($companyJob->email_contact)
                                <li class="list-group-item d-flex align-items-start" style="font-family: 'Montserrat', sans-serif; font-size: 0.9rem;">
                                    <i class="bi bi-envelope me-2"></i>Email:&nbsp;<span id="email">{{ $companyJob->email_contact }}</span>
                                    <button class="btn btn-sm ms-2 p-0" onclick="copyToClipboard('#email')" style="border: none; background: none;">
                                        <i class="bi bi-clipboard-check" style="font-size: 12px;"></i>
                                    </button>
                                </li>
                            @endif
                        </ul>

                        <div style="border-bottom: 1px solid #dee2e6; margin: 1rem 0;"></div>

                        <!-- Application Methods -->
                        <h6 class="mb-3" style="font-family: 'Montserrat', sans-serif; font-size: 1.1rem;"></h6>
                        @if(!$companyJob->is_open)
                            <div class="alert alert-warning text-center" style="font-family: 'Montserrat', sans-serif;">
                                Mohon maaf, lowongan sudah ditutup.
                            </div>
                        @else
                            <div class="">
                               
                                <form method="POST" enctype="multipart/form-data" action="{{ route('frontend.apply.store', $companyJob->slug) }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Deskripsi</label>
                                        <textarea class="form-control" name="message" id="description" rows="5" placeholder="Deskripsikan pengalaman anda secara singkat" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="resume" class="form-label">Upload File PDF CV</label>
                                        <input type="file" class="form-control" name="resume" id="resume" accept=".pdf" required>
                                    </div>
                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Lamar Sekarang</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        


                    <!-- Job Summary Section -->
                    <div class="col-lg-4 col-md-12">
                        <div class="card-loker shadow-sm h-60 position-relative" style="border-radius: 10px; padding: 10px; border: 1px solid #f49721;">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4" style="font-family: 'Montserrat', sans-serif;">Ringkasan</h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item" style="font-family: 'Montserrat', sans-serif;">
                                        <i class="bi bi-calendar me-2"></i>Dipublikasikan: {{ $companyJob->created_at->locale('id')->diffForHumans() }}
                                    </li>
                                    <li class="list-group-item" style="font-family: 'Montserrat', sans-serif;">
                                        <i class="bi bi-person me-2"></i>Total Dibutuhkan: {{ $companyJob->quota }}
                                    </li>
                                    <li class="list-group-item" style="font-family: 'Montserrat', sans-serif;">
                                        <i class="bi bi-person-lines-fill me-2"></i>Jenis Pekerjaan: {{ $companyJob->type }}
                                    </li>
                                    <li class="list-group-item" style="font-family: 'Montserrat', sans-serif;">
                                        <i class="bi bi-cash me-2"></i>Gaji: {{ $companyJob->salary }}
                                    </li>
                                    <li class="list-group-item" style="font-family: 'Montserrat', sans-serif;">
                                        <i class="bi bi-geo-alt me-2"></i>Lokasi: {{ $companyJob->location }}
                                    </li>
                                    <li class="list-group-item" style="font-family: 'Montserrat', sans-serif;">
                                        <i class="bi bi-mortarboard me-2"></i>Pendidikan: {{ $companyJob->education }}
                                    </li>
                                    <li class="list-group-item" style="font-family: 'Montserrat', sans-serif;">
                                        <i class="bi bi-briefcase  me-2"></i>Pengalaman: {{ $companyJob->experience }}
                                    </li>
                                    <li class="list-group-item" style="font-family: 'Montserrat', sans-serif;">
                                        <i class="bi bi-graph-up me-2"></i>Keahlian: {{ $companyJob->skill_level}}
                                    </li>
                                    <li class="list-group-item" style="font-family: 'Montserrat', sans-serif;">
                                        <i class="bi bi-calendar me-2"></i>
                                        Batas Lamaran: 
                                        {{ $companyJob->application_deadline ? \Carbon\Carbon::parse($companyJob->application_deadline)->translatedFormat('d F Y') : 'Tidak ada' }}
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Job Detail End -->


</body>
@endsection


@push('after-scripts')
<!-- JavaScript Libraries -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<script>
    document.getElementById('toggleDropdown').addEventListener('click', function() {
        const dropdown = document.getElementById('contactDropdown');
        dropdown.classList.toggle('d-none'); // Toggles the 'd-none' class
    });

    function copyToClipboard(element) {
        var tempInput = document.createElement("input");
        document.body.appendChild(tempInput);
        tempInput.value = document.querySelector(element).textContent;
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Teks telah disalin!");
    }

    function copyToClipboard(elementId) {
        const textToCopy = document.querySelector(elementId).innerText;
        navigator.clipboard.writeText(textToCopy).then(function() {
            // SweetAlert2 success alert
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Teks telah disalin ke clipboard!',
                showConfirmButton: false,
                timer: 1500
            });
        }, function(err) {
            console.error('Failed to copy text: ', err);
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Gagal menyalin teks!',
            });
        });
    }
</script>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const verifiedIcon = document.getElementById('verified-icon');

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


<!-- Template Javascript -->
<script src="js/main.js"></script>
@endpush