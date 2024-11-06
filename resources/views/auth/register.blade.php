@extends('../layouts.master1')
@section('content')

<body class="font-poppins text-[#0E0140]">

    <div class="container-xxl bg-white p-0">

        <x-nav />

        <div class="container">

            <div class="row justify-content-center py-5">
                <div class="col-md-6">
                    <div class="card p-4 shadow-lg rounded-3">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf
                            <h2 class="text-center mb-4">Daftar</h2>

                            <!-- Avatar Upload -->
                            <div class="mb-3 text-center">
                                <button type="button" id="Upload-btn" class="btn rounded-circle p-0 overflow-hidden" style="width: 100px; height: 100px; border-color: #f49721; color: #f49721;">
                                    <img id="File-thumbnail" src="{{asset('assets/icons/upload-avatar.svg')}}" class="img-fluid" alt="avatar">
                                </button>

                                <input type="file" name="avatar" id="File-upload" class="d-none" accept="image/*">
                                <p class="mt-2">Foto Profil</p>
                                <button type="button" id="Replace-photo-btn" class="btn btn-link text-warning d-none">Ganti Foto Profil</button>
                            </div>

                            <!-- Name -->
                            <div class="form-group mb-3">
                                <label for="Name">Nama</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><img src="{{asset('assets/icons/user.svg')}}" alt="icon"></span>
                                    </div>
                                    <input type="text" name="name" id="Name" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group mb-3">
                                <label for="Email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><img src="{{asset('assets/icons/sms.svg')}}" alt="icon"></span>
                                    </div>
                                    <input type="email" name="email" id="Email" class="form-control" placeholder="Masukkan Email" required>
                                </div>
                            </div>

                            <!-- Occupation & Experience -->
                            <div class="form-row mb-3">
                                <div class="col">
                                    <label for="Occupation">Pekerjaan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="{{asset('assets/icons/note-favorite.svg')}}" alt="icon"></span>
                                        </div>
                                        <input type="text" name="occupation" id="Occupation" class="form-control" placeholder="Masukkan Pekerjaan" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col">
                                    <label for="Experience">Pengalaman</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="{{asset('assets/icons/chart.svg')}}" alt="icon"></span>
                                        </div>
                                        <input type="text" name="experience" id="Experience" class="form-control" placeholder="Masukkan Pengalaman" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3">
                                <label for="Password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><img src="{{asset('assets/icons/lock.svg')}}" alt="icon"></span>
                                    </div>
                                    <input type="password" name="password" id="Password" class="form-control" placeholder="Masukkan Password" required>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mb-4">
                                <label for="Confirm-Password">Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><img src="{{asset('assets/icons/lock.svg')}}" alt="icon"></span>
                                    </div>
                                    <input type="password" name="password_confirmation" id="Confirm-Password" class="form-control" placeholder="Konfirmasi Password" required>
                                </div>
                            </div>

                            <!-- Account Type -->
                            <div class="form-group mb-4">
                                <p>Tipe Akun</p>
                                <div class="form-row">
                                    <div class="col">
                                        <label class="d-flex align-items-center p-3 border rounded">
                                            <input type="radio" value="Employee" name="account_type" id="Employee" class="mr-2" required>
                                            <img src="{{asset('assets/icons/briefcase.svg')}}" alt="icon" class="mr-2"> Karyawan
                                        </label>
                                    </div>
                                     <div class="col">
                                    <label class="d-flex align-items-center p-3 border rounded">
                                        <input type="radio" value="Employer" name="account_type" id="Employer" class="mr-2" required>
                                        <img src="{{asset('assets/icons/building-4.svg')}}" alt="icon" class="mr-2"> As an Employer
                                    </label>
                                </div> 
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 mb-3" style="background-color: #f49721; border-color: #f49721; border-radius: 10px;">Register</button>

                            <!-- Sign In Link -->
                            <div class="text-center">
                                <a href="{{ route('login') }}" class="d-block" style="color: #333333;">Sudah punya akun? Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
   

</body>
@endsection

@push('after-scripts')
<script>
    document.getElementById('Upload-btn').addEventListener('click', function() {
        document.getElementById('File-upload').click();
    });
    document.getElementById('Replace-photo-btn').addEventListener('click', function() {
        document.getElementById('File-upload').click();
    });

    document.getElementById('File-upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('File-thumbnail').src = e.target.result;
                document.getElementById('Replace-photo-btn').classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush