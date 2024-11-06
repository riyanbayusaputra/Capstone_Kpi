<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pekerjaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                <!-- Job Header -->
                <div class="item-card flex flex-col md:flex-row justify-between md:items-center gap-y-10">
                    <div class="flex flex-row items-center gap-x-3">
                        
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $companyJob->name }}</h3>
                            <p class="text-slate-500 text-sm">{{ $companyJob->category->name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        <a href="{{ route('admin.company_jobs.edit', $companyJob) }}" class="font-bold py-4 px-6 bg-indigo-500 text-white rounded-full hover:bg-indigo-600 transition">
                            Edit Pekerjaan
                        </a>
                        <!-- <a href="{{ route('admin.company_jobs.show', $companyJob) }}" class="font-bold py-4 px-6 bg-orange-500 text-white rounded-full hover:bg-orange-600 transition">
                            Preview
                        </a> -->
                    </div>
                </div>

                <!-- Status Toggle Buttons -->
                <div class="flex flex-row gap-x-3 mt-5">
                    <form method="POST" action="{{ route('admin.company_jobs.toggle', $companyJob) }}">
                        @csrf
                        @method('POST')
                        <button type="submit" class="font-bold py-4 px-6 {{ $companyJob->is_open ? 'bg-red-500' : 'bg-green-500' }} text-white rounded-full">
                            {{ $companyJob->is_open ? 'Tutup Lowongan' : 'Buka Lowongan' }}
                        </button>
                    </form>
                </div>

                <hr class="my-5">

                <!-- Job Details -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <div>
                        <p class="text-slate-500 text-sm">Gaji</p>
                        <h3 class="text-indigo-950 text-xl font-bold">
                        {{ $companyJob->salary }}
                        </h3>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Tipe Pekerjaan</p>
                        <h3 class="text-indigo-950 text-xl font-bold">
                            {{ $companyJob->type }}
                        </h3>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Lokasi</p>
                        <h3 class="text-indigo-950 text-xl font-bold">
                            {{ $companyJob->location }}
                        </h3>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Pengalaman</p>
                        <h3 class="text-indigo-950 text-xl font-bold">
                            {{ $companyJob->experience}}
                        </h3>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Tingkat Keahlian</p>
                        <h3 class="text-indigo-950 text-xl font-bold">
                            {{ $companyJob->skill_level }}
                        </h3>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    @if ($companyJob->phone_number)
                        <div>
                            <p class="text-slate-500 text-sm">No. Telepon</p>
                            <h3 class="text-indigo-950 text-xl font-bold">
                                <a href="tel:{{ $companyJob->phone_number }}" class="hover:underline break-all">
                                    {{ $companyJob->phone_number }}
                                </a>
                            </h3>
                        </div>
                    @endif

                    @if ($companyJob->email_contact)
                        <div>
                            <p class="text-slate-500 text-sm">Email</p>
                            <h3 class="text-indigo-950 text-xl font-bold">
                                <a href="mailto:{{ $companyJob->email_contact }}" class="hover:underline break-all">
                                    {{ $companyJob->email_contact }}
                                </a>
                            </h3>
                        </div>
                    @endif

                  


                </div>

                <!-- About Section -->
                <div>
                    <h3 class="text-indigo-950 text-xl font-bold mb-2">Tentang Perusahaan</h3>
                    <p class="text-slate-500 text-sm">
                        {!!$companyJob->about!!}
                    </p>
                </div>

                <!-- Responsibilities and Qualifications -->
                <div class="flex flex-col md:flex-row gap-10">
                    <!-- Responsibilities -->
                    <div class="w-full md:w-1/2">
                        <h3 class="text-indigo-950 text-xl font-bold mb-3">
                            Deskripsi Pekerjaan
                        </h3>
                        @if($companyJob->responsibilities->isNotEmpty())
                            <ul class="list-disc list-inside text-slate-500 text-base">
                                @foreach($companyJob->responsibilities as $responsibility)
                                    <li>{{ $responsibility->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-slate-500 text-sm">Tidak ada deskripsi pekerjaan.</p>
                        @endif
                    </div>

                    <!-- Qualifications -->
                    <div class="w-full md:w-1/2">
                        <h3 class="text-indigo-950 text-xl font-bold mb-3">
                            Syarat Pekerjaan
                        </h3>
                        @if($companyJob->qualifications->isNotEmpty())
                            <ul class="list-disc list-inside text-slate-500 text-base">
                                @foreach($companyJob->qualifications as $qualification)
                                    <li>{{ $qualification->name }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-slate-500 text-sm">Tidak ada kualifikasi.</p>
                        @endif
                    </div>
                </div>

                <hr class="my-5">

                <!-- Candidates Section -->
                <div>
                    <h3 class="text-indigo-950 text-xl font-bold mb-5">Calon Pekerja</h3>

                    @forelse($companyJob->Candidates as $candidate)
                        <div class="flex flex-col md:flex-row justify-between items-center gap-y-5 md:gap-y-0">
                            <div class="flex flex-row items-center gap-x-3">
                                <img src="{{ Storage::url($candidate->profile->avatar) }}" alt="{{ $candidate->profile->name }}" class="rounded-full object-cover w-[70px] h-[70px]">
                                <div class="flex flex-col">
                                    <h3 class="text-indigo-950 text-xl font-bold">
                                        <a href="{{ route('admin.job_candidates.show', $candidate) }}" class="hover:underline">
                                            {{ $candidate->profile->name }}
                                        </a>
                                    </h3>
                                    <p class="text-slate-500 text-sm">
                                        {{ $candidate->profile->occupation }} - {{ $candidate->profile->experience }} yrs
                                    </p>
                                </div>
                            </div>

                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full 
                                @if($candidate->is_hired == 'hired') bg-green-500 
                                @elseif($candidate->is_hired == 'waiting') bg-orange-500 
                                @elseif($candidate->is_hired == 'rejected') bg-red-500 
                                @endif 
                                text-white">
                                {{ strtoupper($candidate->is_hired) }}
                            </span>

                            <div class="flex flex-row items-center gap-x-3">
                                <a href="{{ route('admin.job_candidates.show', $candidate) }}" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 transition">
                                    Details
                                </a>
                            </div>
                        </div>
                        <hr class="my-4">
                    @empty
                        <p class="text-slate-500 text-sm">Belum ada kandidat yang tertarik pada proyek ini.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
