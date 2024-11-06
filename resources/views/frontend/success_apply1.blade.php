@extends('../layouts.master1')

@section('content')

<body class="bg-primary text-white">
    <div class="container-xxl bg-primary p-0">
        <!-- Navbar Start -->
        <x-nav />
        <!-- Navbar End -->


        <!-- Success Message Start -->
        <div class="flex-1 flex items-center justify-center" style="min-height: 100vh;">
            <div class="d-flex flex-column align-items-center justify-content-center gap-3 my-auto text-center">
                <div class="flex-shrink-0">
                    <img src="{{ asset('assets/backgrounds/success illustration.png') }}" class="img-fluid" alt="success illustration" style="width: 330px; height: 330px;">
                </div>
                <div class="flex flex-column gap-2">
                    <p class="font-weight-bold display-4">Well, Great Work!</p>
                    <p>We have received your application and the recruiter will review it in a couple of business days.</p>
                </div>
                <a href="{{ route('frontend.index') }}" class="btn btn-warning rounded-pill px-4 py-2">Explore Other Jobs</a>
            </div>
        </div>
        <!-- Success Message End -->

       
    </div>
</body>
@endsection

@push('after-scripts')
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush