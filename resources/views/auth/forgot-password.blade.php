@extends('../layouts.master1')
@section('content')

<body class="font-poppins text-[#0E0140]">

    <div class="container-xxl bg-white p-0">

        <x-nav />

        <div class="container">
            <!-- Password Reset Form Section -->
            <div class="row justify-content-center py-5">
                <div class="col-md-6">
                    <div class="card p-4 shadow-lg rounded-3">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <h2 class="mb-4 text-center">Lupa Password</h2>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <img src="{{ asset('assets/icons/sms.svg') }}" alt="email icon" />
                                    </span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Masukkan Email" required autofocus value="{{ old('email') }}">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn w-100 mb-3 text-white" style="background-color: #f49721; border-color: #f49721; border-radius: 10px;">Kirim Link Lupa Password</button>

                            <!-- Links -->
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="d-block mb-2" style="color: #333333;">Kembali ke Login</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
