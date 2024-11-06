@extends('../layouts.master1')
@section('content')

<body class="font-poppins text-[#0E0140]">

    <div class="container-xxl bg-white p-0">


        <x-nav />

        <div class="container">

            <!-- Login Form Section -->
            <div class="row justify-content-center py-5">
                <div class="col-md-6">
                    <div class="card p-4 shadow-lg rounded-3">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <h2 class="mb-4 text-center">Login</h2>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <img src="{{asset('assets/icons/sms.svg')}}" alt="email icon" />
                                    </span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan Email" required autofocus>
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <img src="{{asset('assets/icons/lock.svg')}}" alt="password icon" />
                                    </span>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                            </div>

                            <!-- Login Button -->
                            <button type="submit" class="btn w-100 mb-3 text-white" style="background-color: #f49721; border-color: #f49721; border-radius: 10px;">Login</button>

                            <!-- Links -->
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="d-block mb-2" style="color: #333333;">Lupa Password</a>
                                @endif
                                <a href="{{ route('register') }}" class="d-block" style="color: #333333;">Belum punya akun? Register</a>
                            </div>

                            <!-- Social Login Buttons -->
                            <div class="mt-4 text-center">
                                <!-- <button type="button" class="btn btn-outline-dark w-100 mb-2">
                                <img src="../images/logososmed/google.png" alt="Google" class="me-2"/> Login with Google
                            </button> -->

                            </div>
                        </form>
                    </div>
                    </div>
                    </div>
        </div>
</body>
@endsection