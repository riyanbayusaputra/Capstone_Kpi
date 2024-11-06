<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Link Tautan') }}
            </h2>
            <a href="{{ route('links.index') }}" class="font-bold py-2 px-4 bg-gray-500 text-white rounded-full">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <form action="{{ route('links.update', $link->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block text-gray-700 font-bold">Judul</label>
                        <input type="text" name="title" id="title" value="{{ $link->title }}" class="w-full border border-gray-300 rounded-lg p-3 mt-2" placeholder="Masukkan judul link" required>
                    </div>



                    <div>
                        <label for="content" class="block text-gray-700 font-bold">Konten</label>

                        <!-- CKEditor -->
                        <textarea id="content" name="content" class="w-full border border-gray-300 rounded-lg p-3 mt-2" placeholder="Masukkan konten" rows="4">{{ $link->content }}</textarea>
                    </div>


                    <button type="submit" class="py-2 px-4 bg-indigo-700 text-white font-bold rounded-full">
                        Edit
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.25.0/lts/standard/ckeditor.js"></script>

    <script>
        // Inisialisasi CKEditor
        CKEDITOR.replace('content', {
            toolbar: 'Basic', // Pilih toolbar yang diinginkan
            height: 200 // Tinggi CKEditor
        });
    </script>

</x-app-layout>