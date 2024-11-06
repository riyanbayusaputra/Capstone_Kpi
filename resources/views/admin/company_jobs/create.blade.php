<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Pekerjaan') }}
            </h2>
            <a href="{{ route('admin.company_jobs.index') }}" class="font-bold py-2 px-4 bg-gray-500 text-white rounded-full">
                Kembali
            </a>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('admin.company_jobs.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Posisi')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                   

                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Tipe')" />

                        <select name="type" id="type" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="Formal">Formal</option>
                            <option value="Non-Formal">Non-Formal</option>

                        </select>

                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="quota" :value="__('Dibutuhkan')" />
                        <x-text-input id="quota" class="block mt-1 w-full" type="number" name="quota" :value="old('quota')" required autofocus autocomplete="quota" />
                        <x-input-error :messages="$errors->get('quota')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="salary" :value="__('Gaji')" />
                        <x-text-input id="salary" name="salary" class="block mt-1 w-full" type="text" required autofocus autocomplete="off" :value="old('salary')" />
                        <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                    </div>


                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Lokasi')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required autofocus autocomplete="location" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="skill_level" :value="__('Tingkat Keahlian')" />

                        <select name="skill_level" id="skill_level" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Expert">Expert</option>
                        </select>

                        <x-input-error :messages="$errors->get('skill_level')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Kategori')" />

                        <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>


                    <div class="mt-4">
                        <x-input-label for="about" :value="__('Tentang Perusahaan')" />
                        <x-text-input id="about" class="block mt-1 w-full" type="hidden" name="about" />
                        <trix-editor input="about" class="rounded-1"></trix-editor>

                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    <hr class="my-5">

                    <div class="mt-4">
                        <x-input-label for="responsibilities" :value="__('Deskripsi Pekerjaan')" />

                        <div id="responsibilities-container" class="flex flex-col gap-y-2">
                            <!-- Input tanggung jawab baru akan ditambahkan di sini -->
                        </div>

                        <button type="button" id="add-responsibility" class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded">Tambah Deskripsi Pekerjaan</button>
                        <x-input-error :messages="$errors->get('responsibilities')" class="mt-2" />
                    </div>

                    <hr class="my-5">

                    <div class="mt-4">
                        <x-input-label for="qualifications" :value="__('Syarat Pekerjaan')" />

                        <div id="qualifications-container" class="flex flex-col gap-y-2">
                            <!-- Input kualifikasi baru akan ditambahkan di sini -->
                        </div>

                        <button type="button" id="add-qualification" class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded">Tambah Kualifikasi</button>
                        <x-input-error :messages="$errors->get('qualifications')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="education" :value="__('Pendidikan')" />

                        <select name="education" id="education" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="Semua Lulusan">Semua Lulusan</option>
                            <option value="SD - SMP">SD – SMP</option>
                            <option value="SMA / SMK">SMA / SMK</option>
                            <option value="D1 - D3">D1 – D3</option>
                            <option value="S1 / D4">S1 / D4</option>
                            <option value="S2 / Profesi">S2 / Profesi</option>
                        </select>

                        <x-input-error :messages="$errors->get('education')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="experience" :value="__('Pengalaman')" />

                        <select name="experience" id="experience" class="py-3 rounded-lg pl-3 w-full border border-slate-300">

                            <option value="">Pengalaman</option>
                            <option value="Tanpa Pengalaman">Tanpa Pengalaman</option>
                            <option value="1-2 Tahun">1 - 2 Tahun</option>
                            <option value="3-4 Tahun">3 - 4 Tahun</option>
                            <option value="5 Tahun Lebih">5 Tahun Lebih</option>

                        </select>

                        <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="phone_number" :value="__('Nomor Telepon')" />
                        <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" placeholder="+62 812 3456 7890" required />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>

                   
                    <div class="mt-4">
                        <x-input-label for="email_contact" :value="__('Email Contact')" />
                        <x-text-input id="email_contact" class="block mt-1 w-full" type="email" name="email_contact" :value="old('email_contact')" placeholder="example@example.com" />
                        <x-input-error :messages="$errors->get('email_contact')" class="mt-2" />
                    </div>

                  


                    <div class="mt-4">
                        <x-input-label for="verified" :value="__('Loker Terverifikasi')" />

                        <x-text-input id="verified" class="block mt-1 w-full" type="text" name="verified" :value="old('verified')" placeholder="Masukkan status verifikasi" />

                        <x-input-error :messages="$errors->get('verified')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="application_deadline" :value="__('Batas Lamaran')" />
                    
                        <x-text-input id="application_deadline" class="block mt-1 w-full" type="date" name="application_deadline" :value="old('application_deadline')" placeholder="Masukkan batas lamaran" />
                    
                        <x-input-error :messages="$errors->get('application_deadline')" class="mt-2" />
                    </div>
                    

                     <input type="hidden" name="company_id" value="{{ $my_company->id }}">


                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Tambah Pekerjaan Baru
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