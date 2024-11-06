@extends('../layouts.master1')
@section('content')

<body class="font-poppins text-[#0E0140]">

    <div class="container-xxl bg-white p-0">
        <x-nav />

        <div class="container">
            <!-- Verify Email Form Section -->
            <div class="row justify-content-center py-5">
                <div class="col-md-6">
                    <div class="card p-4 shadow-lg rounded-3">
                        <!-- Thank You Message -->
                        <h2 class="mb-4 text-center">Verifikasi Email</h2>
                        <div class="mb-4 text-sm text-gray-600 text-center">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </div>

                        <!-- Status Message -->
                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 font-medium text-sm text-green-600 text-center">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <!-- Resend Verification Email Form -->
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <div class="d-grid gap-2 mb-3">
                                <button type="submit" class="btn text-white" style="background-color: #f49721; border-color: #f49721; border-radius: 10px;">
                                    {{ __('Kirim Verifikasi Email') }}
                                </button>
                            </div>
                        </form>

                        <!-- Log Out Form -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-outline-dark w-100" style="border-radius: 10px;">
                                    {{ __('Log Out') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
