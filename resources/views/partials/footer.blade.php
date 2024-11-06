<style>
    .back-to-top {
        display: inline-flex;
        /* Memastikan tombol dapat dilihat di perangkat kecil */
        justify-content: center;
        align-items: center;
    }

    /* Tambahan untuk ukuran tombol */
    .btn-lg {
        padding: 0.5rem 1rem;
        /* Sesuaikan padding jika perlu */
    }

    /* Mengatur agar tombol tidak terlalu besar di layar kecil */
    @media (max-width: 576px) {
        .btn-lg {
            padding: 0.3rem 0.5rem;
            /* Padding lebih kecil untuk mobile */
            font-size: 0.8rem;
            /* Ukuran font lebih kecil untuk mobile */
        }
    }
</style>


<!-- Footer Start -->
<footer class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 position-relative wow fadeIn" data-wow-delay="0.1s">
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
                    &copy; 2024 JobHub
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Overlay -->
    <div class="footer-overlay"></div>

</footer>
<!-- Footer End -->