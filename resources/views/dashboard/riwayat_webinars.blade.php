<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Riwayat Webinar') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($registrations->isEmpty())
                    <p class="text-center">Anda belum mendaftar untuk webinar apapun.</p>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                        Judul Webinar
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                        Tanggal Mulai
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                        Tanggal Selesai
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                        Link Webinar
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                                        Sertifikat
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($registrations as $index => $registration)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500 truncate max-w-xs">
                                        {{ $registration->webinar->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                        {{ $registration->webinar->tanggal_mulai }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                        {{ $registration->webinar->tanggal_selesai }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                        @if($registration->link)
                                        <a href="{{ $registration->link }}" target="_blank" class="text-blue-600 hover:underline">
                                            {{ $registration->link }}
                                        </a>
                                        @else
                                        Belum Ada Link Webinar
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                        Terdaftar
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-500">
                                        @if($registration->certificate)
                                        <a href="{{ asset('storage/' . $registration->certificate) }}" target="_blank" class="text-blue-600 hover:underline">
                                            Lihat Sertifikat
                                        </a>
                                        <a href="{{ asset('storage/' . $registration->certificate) }}" download class="text-blue-600 hover:underline ml-2">
                                            Download Sertifikat
                                        </a>
                                        @else
                                        Belum Ada Sertifikat
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if (session('status'))
    <div class="bg-green-500 text-white p-4 rounded">
        {{ session('status') }}
    </div>
    @endif
</x-app-layout>