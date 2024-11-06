<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Tautan') }}
            </h2>
            <a href="{{ route('links.create') }}" class="mt-4 sm:mt-0 px-6 py-3 bg-indigo-600 text-white rounded-full font-semibold hover:bg-indigo-700 transition duration-300 text-center">
                Tambah Link Tautan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg overflow-hidden sm:rounded-lg p-10 flex flex-col gap-y-5">
                <!-- Iterasi untuk setiap link -->
                @foreach ($links as $link)
                <div class="item-card flex flex-col sm:flex-row justify-between items-start sm:items-center bg-gray-100 p-5 rounded-lg shadow-md">
                    <div class="flex flex-col">
                        <h3 class="text-indigo-950 text-xl font-bold">
                            {{ $link->title }}
                        </h3>
                        {{-- <p class="text-slate-500 text-sm">
                                <a href="{{ $link->url }}" target="_blank" class="text-indigo-600 underline">
                        {{ $link->url }}
                        </a>
                        </p>
                        <p class="text-slate-500 text-sm mt-2">
                            {{ $link->content }}
                        </p> --}}
                    </div>
                    <div class="flex flex-row sm:items-center gap-x-3 mt-4 sm:mt-0">
                        <a href="{{ route('links.edit', $link->id) }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('links.destroy', $link->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-2 px-4 bg-red-600 text-white rounded-full">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Data ini akan dihapus secara permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>