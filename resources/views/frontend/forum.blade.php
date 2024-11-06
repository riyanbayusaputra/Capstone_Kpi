<!-- resources/views/forum.blade.php -->
@extends('../layouts.master1')

@section('content')

<x-nav />

<div class="container-fluid d-flex justify-content-center">
    <div class="row col-lg-9 col-md-10 mx-auto">

        <!-- Main Content -->
        <div class="col-lg-12 col-md-12">
            <h1 class="my-4 text-center">Forum Diskusi</h1>

            <!-- Input Container -->
            <div class="mb-4">
                <div class="mb-3">
                    <label for="title" class="form-label">Pilih Kategori</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="title-option" id="option1" value="work-life">
                        <label class="form-check-label" for="option1">Kewirausahaan</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="title-option" id="option2" value="keterampilan">
                        <label class="form-check-label" for="option2">Keterampilan Kerja</label>
                    </div>
                </div>

                <textarea class="form-control mb-3" placeholder="Isi Postingan"></textarea>

                <div class="d-flex justify-content-between align-items-center">
                    <div class="tags">
                        <span class="badge bg-secondary">#Bisnis</span>
                        <span class="badge bg-secondary">#Pengalaman-Kerja</span>
                        <span class="badge bg-secondary">#Pengembangan-Karir</span>
                        <span class="badge bg-secondary">#Kewirausahaan</span>
                    </div>
                    <button class="btn btn-primary" onclick="location.href='#popup1';">Post</button>
                </div>
            </div>

            <!-- Pop-up for success message -->
            <div id="popup1" class="overlay">
                <div class="popup">
                    <h2>Success</h2>
                    <a class="close" href="#">&times;</a>
                    <div class="content">
                        Postingan Anda telah berhasil diposting!
                    </div>
                </div>
            </div>

            <!-- Recent Posts Section -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Terkini</h4>
                <a href="#" class="btn btn-outline-secondary"><i class="fa fa-refresh"></i> Refresh</a>
            </div>

            <!-- Post List -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/profil0.png') }}" alt="Profile Image" class="rounded-circle me-2" style="width: 50px;">
                            <div>
                                <h5 class="mb-0">Joseph</h5>
                                <p class="text-muted mb-0">Posted 1 jam yang lalu</p>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#"><i class="fa fa-exclamation-triangle"></i> Laporkan</a></li>
                            </ul>
                        </div>
                    </div>
                    <h6 class="mt-3">Keterampilan Kerja</h6>
                    <p>Ada tips untuk menambah produktivitas di kantor?</p>
                    <div class="tags">
                        <span class="badge bg-secondary">#seputar-kerjaan</span>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <button class="btn btn-link text-decoration-none"><i class="fa fa-reply"></i> 3 balasan</button>
                    <div class="d-flex">
                        <span class="me-3"><i class="fa fa-comment"></i> 10</span>
                        <!-- <span class="me-3"><i class="fa fa-eye"></i> 100</span>
                        <span><i class="fa fa-heart"></i> 50</span> -->
                    </div>
                </div>
            </div>

            <!-- Comment Form -->
            <div class="mb-4">
                <textarea class="form-control mb-2" placeholder="Ketikkan sesuatu..."></textarea>
                <button class="btn btn-primary">Post Comment</button>
            </div>
        </div>
    </div>
</div>


<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-12 text-left">
                <h5 class="text-white mb-4">About Us</h5>

                <!-- Menggunakan flexbox untuk tampilan horizontal -->
                <div class="d-flex flex-wrap">
                    @forelse ($links as $link)
                    <a class="text-white-50 mx-2" href="{{ route('show.content', ['link_laman' => $link->title]) }}" target="_blank">{{ $link->title }}</a>
                    @if (!$loop->last)
                    <span class="text-white-50 mx-2">/</span> <!-- Separator untuk setiap link kecuali yang terakhir -->
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