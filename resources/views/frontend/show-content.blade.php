@extends('../layouts.master1')

@section('content')

<body>
    <div class="container-xxl bg-white p-0">
        <x-nav />

        <!-- Content Start -->
        <section class="content-section py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12"> <!-- Full width container for larger screens -->
                        <!-- Title and content -->
                        <h3 class="text-primary mb-4 font-weight-bold">{{ $link->title }}</h3>

                        <article class="content-body text-dark content-article" style="max-width: 100%; line-height: 1.8; word-wrap: break-word;">
                            {!! $link->content !!}
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content End -->

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
