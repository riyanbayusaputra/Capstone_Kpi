<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tambah Link Tautan') }}
            </h2>
            <a href="{{ route('links.index') }}" class="font-bold py-2 px-4 bg-gray-500 text-white rounded-full">
                Kembali
            </a>
        </div>
    </x-slot>

    <!-- Tambahkan di bagian <head> -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <form action="{{ route('links.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="title" class="block text-gray-700 font-bold">Judul</label>
                        <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded-lg p-3 mt-2" placeholder="Masukkan judul link" required>
                    </div>


                    <div>
                        <label for="content" class="block text-gray-700 font-bold">Konten</label>

                        <!-- Quill Editor -->
                        <div id="editor" class="w-full border border-gray-300 rounded-lg p-3 mt-2"></div>

                        <!-- Hidden field to store the content -->
                        <input type="hidden" id="content" name="content" value="{{ old('content') }}">
                    </div>



                    <button type="submit" class="py-2 px-4 bg-indigo-700 text-white font-bold rounded-full">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tambahkan sebelum akhir tag </body> -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'align': []
                    }], // Menambahkan opsi align (rata kiri, kanan, tengah)
                    ['clean']
                ]
            }
        });

        // Set the initial content from old input
        quill.root.innerHTML = `{!! old('content') !!}`;

        // Update hidden input field on form submit
        document.querySelector('form').onsubmit = function() {
            document.querySelector('input[name=content]').value = quill.root.innerHTML;
        };
    </script>


</x-app-layout>