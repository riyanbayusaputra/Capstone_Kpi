<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Pekerjaan') }}
            </h2>
            <a href="{{ route('admin.company_jobs.index') }}" class="font-bold py-2 px-4 bg-gray-500 text-white rounded-full">
                Kembali
            </a>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('admin.company_jobs.update', $companyJob->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="__('Posisi')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $companyJob->name) }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                   

                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Tipe')" />
                        <select name="type" id="type" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="Formal" {{ old('type', $companyJob->type) == 'Formal' ? 'selected' : '' }}>Formal</option>
                            <option value="Non-Formal" {{ old('type', $companyJob->type) == 'Non-Formal' ? 'selected' : '' }}>Non-Formal</option>

                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="salary" :value="__('Gaji IDR per Bulan')" />
                        <x-text-input id="salary" name="salary" class="block mt-1 w-full" type="text" placeholder="Masukkan gaji" required autofocus autocomplete="off" value="{{ old('salary', $companyJob->salary) }}" />
                        <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                    </div>


                    <div class="mt-4">
                        <x-input-label for="quota" :value="__('Kuota')" />
                        <x-text-input id="quota" class="block mt-1 w-full" type="number" name="quota" value="{{ old('quota', $companyJob->quota) }}" required autofocus autocomplete="quota" />
                        <x-input-error :messages="$errors->get('quota')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Lokasi')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" value="{{ old('location', $companyJob->location) }}" required autofocus autocomplete="location" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="skill_level" :value="__('Tingkat Keahlian')" />
                        <select name="skill_level" id="skill_level" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="Beginner" {{ old('skill_level', $companyJob->skill_level) == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="Intermediate" {{ old('skill_level', $companyJob->skill_level) == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Expert" {{ old('skill_level', $companyJob->skill_level) == 'Expert' ? 'selected' : '' }}>Expert</option>
                        </select>
                        <x-input-error :messages="$errors->get('skill_level')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Kategori')" />
                        <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $companyJob->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>


                    <div class="mt-4">
                        <x-input-label for="about" :value="__('Tentang Perusahaan')" />
                        <input id="about" type="hidden" name="about" value="{{ old('about', $companyJob->about) }}" />
                        <trix-editor input="about" class="rounded-1"></trix-editor>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="responsibilities" :value="__('Deskripsi Pekerjaan')" />
                        <div id="responsibilities-container" class="flex flex-col gap-y-2">
                            @foreach ($companyJob->responsibilities as $responsibility)
                            <div class="flex items-center gap-x-2">
                                <input type="text" class="py-3 rounded-lg border-slate-300 border flex-1" placeholder="Tulis tanggung jawab" name="responsibilities[]" value="{{ old('responsibilities[]', $responsibility->name) }}">
                                <button type="button" class="text-red-500 remove-responsibility">Hapus</button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-responsibility" class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded">Tambah Tanggung Jawab</button>
                        <x-input-error :messages="$errors->get('responsibilities')" class="mt-2" />
                    </div>


                    <!-- Kualifikasi -->
                    <div class="mt-4">
                        <x-input-label for="qualifications" :value="__('Syarat Pekerjaan')" />
                        <div id="qualifications-container" class="flex flex-col gap-y-2">
                            @foreach ($companyJob->qualifications as $qualification)
                            <div class="flex items-center gap-x-2">
                                <input type="text" class="py-3 rounded-lg border-slate-300 border flex-1" placeholder="Tulis kualifikasi" name="qualifications[]" value="{{ old('qualifications[]', $qualification->name) }}">
                                <button type="button" class="text-red-500 remove-qualification">Hapus</button>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-qualification" class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded">Tambah Kualifikasi</button>
                        <x-input-error :messages="$errors->get('qualifications')" class="mt-2" />
                    </div>

                    <!-- Pendidikan -->
                    <div class="mt-4">
                        <x-input-label for="education" :value="__('Pendidikan')" />
                        <select name="education" id="education" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="Semua Lulusan" {{ old('education', $companyJob->education) == 'Semua Lulusan' ? 'selected' : '' }}>Semua Lulusan</option>
                            <option value="SD - SMP" {{ old('education', $companyJob->education) == 'SD - SMP' ? 'selected' : '' }}>SD - SMP</option>
                            <option value="SMA / SMK" {{ old('education', $companyJob->education) == 'SMA / SMK' ? 'selected' : '' }}>SMA / SMK</option>
                            <option value="D1 - D3" {{ old('education', $companyJob->education) == 'D1 - D3' ? 'selected' : '' }}>D1 - D3</option>
                            <option value="S1 / D4" {{ old('education', $companyJob->education) == 'S1 / D4' ? 'selected' : '' }}>S1 / D4</option>
                            <option value="S2 / Profesi" {{ old('education', $companyJob->education) == 'S2 / Profesi' ? 'selected' : '' }}>S2 / Profesi</option>

                        </select>
                        <x-input-error :messages="$errors->get('education')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="experience" :value="__('Pengalaman')" />

                        <select name="experience" id="experience" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">Pengalaman</option>
                            <option value="Tanpa Pengalaman" {{ old('experience', $companyJob->experience) == 'Tanpa Pengalaman' ? 'selected' : '' }}>Tanpa Pengalaman</option>
                            <option value="1-2 Tahun" {{ old('experience', $companyJob->experience) == '1-2 Tahun' ? 'selected' : '' }}>1 - 2 Tahun</option>
                            <option value="3-4 Tahun" {{ old('experience', $companyJob->experience) == '3-4 Tahun' ? 'selected' : '' }}>3 - 4 Tahun</option>
                            <option value="5 Tahun Lebih" {{ old('experience', $companyJob->experience) == '5 Tahun Lebih' ? 'selected' : '' }}>5 Tahun Lebih</option>
                        </select>

                        <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                    </div>


                    <!-- Nomor Telepon -->
                    <div class="mt-4">
                        <x-input-label for="phone_number" :value="__('Nomor Telepon')" />
                        <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" value="{{ old('phone_number', $companyJob->phone_number) }}" placeholder="+62..." />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>



                    <div class="mt-4">
                        <x-input-label for="email_contact" :value="__('Email Contact')" />
                        <x-text-input id="email_contact" class="block mt-1 w-full" type="email" name="email_contact" value="{{ old('email_contact', $companyJob->email_contact) }}" placeholder="contact@example.com" />
                        <x-input-error :messages="$errors->get('email_contact')" class="mt-2" />
                    </div>


                    <div class="mt-4">
        <x-input-label for="verified" :value="__('Perusahaan Terverifikasi')" />
        
        <x-text-input id="verified" class="block mt-1 w-full" type="text" name="verified" :value="old('verified', $companyJob->verified)" placeholder="Masukkan status verifikasi" />

        <x-input-error :messages="$errors->get('verified')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="application_deadline" :value="__('Batas Lamaran')" />
    
        <x-text-input id="application_deadline" class="block mt-1 w-full" type="date" name="application_deadline" :value="old('application_deadline')" placeholder="Masukkan batas lamaran" />
    
        <x-input-error :messages="$errors->get('application_deadline')" class="mt-2" />
    </div>
    



                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit Pekerjaan
                        </button>
                    </div>
                </form>



            </div>
        </div>
    </div>
    <script>
        document.getElementById('add-responsibility').addEventListener('click', function() {
            let container = document.getElementById('responsibilities-container');
            let div = document.createElement('div');
            div.className = 'flex items-center gap-x-2 mt-2';

            let input = document.createElement('input');
            input.type = 'text';
            input.name = 'responsibilities[]';
            input.className = 'p-2 border border-gray-300 rounded w-full';
            input.placeholder = 'Masukkan Deskripsi Pekerjaan';

            let removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'bg-red-500 text-white px-2 py-1 rounded';
            removeButton.innerText = 'Hapus';
            removeButton.addEventListener('click', function() {
                container.removeChild(div);
            });

            div.appendChild(input);
            div.appendChild(removeButton);
            container.appendChild(div);
        });

        document.getElementById('add-qualification').addEventListener('click', function() {
            let container = document.getElementById('qualifications-container');
            let div = document.createElement('div');
            div.className = 'flex items-center gap-x-2 mt-2';

            let input = document.createElement('input');
            input.type = 'text';
            input.name = 'qualifications[]';
            input.className = 'p-2 border border-gray-300 rounded w-full';
            input.placeholder = 'Masukkan Kualifikasi Pekerjaan';

            let removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'bg-red-500 text-white px-2 py-1 rounded';
            removeButton.innerText = 'Hapus';
            removeButton.addEventListener('click', function() {
                container.removeChild(div);
            });

            div.appendChild(input);
            div.appendChild(removeButton);
            container.appendChild(div);
        });
    </script>
</x-app-layout>