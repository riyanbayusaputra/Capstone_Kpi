<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'JobHub') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
        <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

        <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
        <style>
            trix-toolbar [data-trix-button-group="file-tools"]{
            display: none;
            }
    
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script>
document.addEventListener('DOMContentLoaded', function () {
    // Inisialisasi untuk kategori
    var categorySelect = document.getElementById('category_id');
    if (categorySelect) {
        new Choices(categorySelect, {
            searchEnabled: true,       // Mengaktifkan fitur pencarian
            removeItemButton: true,    // Memungkinkan pengguna menghapus item yang dipilih
            placeholderValue: 'Pilih Kategori', // Placeholder saat belum ada yang dipilih
            noResultsText: 'Tidak ada hasil yang ditemukan', // Pesan jika pencarian tidak ditemukan
        });
    } else {
        console.error('Elemen dengan id category_id tidak ditemukan.');
    }

    // Inisialisasi untuk perusahaan
    const companySelect = new Choices('#company_id', {
        searchEnabled: true,
        placeholder: true,
        placeholderValue: 'Pilih Perusahaan',
        removeItemButton: true,
    });

    // Inisialisasi untuk tipe pekerjaan
    const typeSelect = new Choices('#type', {
        searchEnabled: true,
        placeholder: true,
        placeholderValue: 'Pilih Tipe Pekerjaan',
        removeItemButton: true,
    });

    // Inisialisasi untuk tingkat keahlian
    var skillLevelSelect = document.getElementById('skill_level');
    if (skillLevelSelect) {
        new Choices(skillLevelSelect, {
            searchEnabled: true,       // Mengaktifkan fitur pencarian
            removeItemButton: true,    // Memungkinkan pengguna menghapus item yang dipilih
            placeholderValue: 'Pilih Tingkat', // Placeholder saat belum ada yang dipilih
            noResultsText: 'Tidak ada hasil yang ditemukan', // Pesan jika pencarian tidak ditemukan
        });
    } else {
        console.error('Elemen dengan id skill_level tidak ditemukan.');
    }

    // Menangani penambahan tanggung jawab
    document.getElementById('add-responsibility').addEventListener('click', function() {
        const container = document.getElementById('responsibilities-container');

        // Membuat elemen wrapper untuk input dan tombol hapus
        const div = document.createElement('div');
        div.className = 'flex gap-x-2 items-center';

        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'responsibilities[]';
        newInput.placeholder = 'Tulis tanggung jawab Anda';
        newInput.className = 'py-3 rounded-lg border-slate-300 border mt-2 w-full';
        newInput.required = true; // optional: jika ingin menjadikan input ini wajib diisi

        // Membuat tombol hapus
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'mt-2 bg-red-600 text-white px-4 py-2 rounded';
        deleteButton.innerText = 'Hapus';

        // Menambahkan event listener untuk menghapus input
        deleteButton.addEventListener('click', function() {
            div.remove();
        });

        // Menambahkan input dan tombol hapus ke dalam div
        div.appendChild(newInput);
        div.appendChild(deleteButton);

        // Menambahkan div ke dalam container
        container.appendChild(div);
    });

    // Menangani penambahan kualifikasi
    document.getElementById('add-qualification').addEventListener('click', function() {
        const container = document.getElementById('qualifications-container');

        // Membuat elemen wrapper untuk input dan tombol hapus
        const div = document.createElement('div');
        div.className = 'flex gap-x-2 items-center';

        const newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'qualifications[]';
        newInput.placeholder = 'Tulis kualifikasi Anda';
        newInput.className = 'py-3 rounded-lg border-slate-300 border mt-2 w-full';
        newInput.required = true; // optional: jika ingin menjadikan input ini wajib diisi

        // Membuat tombol hapus
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'mt-2 bg-red-600 text-white px-4 py-2 rounded';
        deleteButton.innerText = 'Hapus';

        // Menambahkan event listener untuk menghapus input
        deleteButton.addEventListener('click', function() {
            div.remove();
        });

        // Menambahkan input dan tombol hapus ke dalam div
        div.appendChild(newInput);
        div.appendChild(deleteButton);

        // Menambahkan div ke dalam container
        container.appendChild(div);

    });
});
        
document.addEventListener('DOMContentLoaded', function () {
    const salaryDisplayInput = document.getElementById('salary_display');
    const salaryInput = document.getElementById('salary');

    salaryDisplayInput.addEventListener('input', function () {
        let value = salaryDisplayInput.value.replace(/[^,\d]/g, '').toString();
        if (value) {
            const split = value.split(',');
            const sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            salaryDisplayInput.value = 'Rp ' + rupiah;

            // Update nilai yang sebenarnya dalam input hidden
            salaryInput.value = value.replace(/\./g, '');
        } else {
            salaryDisplayInput.value = '';
            salaryInput.value = '';
        }
    });
});




    </script>
        

     </script>

    </body>
</html>
