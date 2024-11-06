<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Perusahaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <form action="{{ route('perusahaan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Nama Perusahaan -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Logo Perusahaan -->
                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700">Logo Perusahaan</label>
                            <input type="file" name="logo" id="logo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('logo')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tentang Perusahaan -->
                        <div>
                            <label for="about" class="block text-sm font-medium text-gray-700">Tentang Perusahaan</label>
                            <x-text-input id="about" class="block mt-1 w-full" type="hidden" name="about" />
                            <trix-editor input="about" class="rounded-1">{{ old('about') }}</trix-editor>
                            @error('about')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol Kirim -->
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-700 text-white rounded-full font-semibold hover:bg-indigo-800">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
