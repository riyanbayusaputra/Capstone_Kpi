<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Candidate Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                <div class="item-card flex flex-row gap-y-10 justify-between md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{Storage::url($jobCandidate->job->thumbnail)}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">  {{ $jobCandidate->job->name }}</h3>
                            <p class="text-slate-500 text-sm"> {{ $jobCandidate->job->category->name }}</p>
                        </div>
                        
                    </div>
                    <div class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Salary</p>
                        <h3 class="text-indigo-950 text-xl font-bold">
                            {{($jobCandidate->job->salary) }}
                        </h3>
                    </div>
                    <div class="hidden md:flex flex-col">
                        <p class="text-slate-500 text-sm">Type</p>
                        <h3 class="text-indigo-950 text-xl font-bold">
                            {{  $jobCandidate->job->type}}
                        </h3>
                    </div>
                </div>

                <hr class="my-5">

                <h3 class="text-indigo-950 text-xl font-bold">My Profile</h3>

                <div class="flex flex-row items-center justify-between">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{Storage::url($jobCandidate->profile->avatar)}} " alt="" class="rounded-full object-cover w-[70px] h-[70px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $jobCandidate->profile->name}}</h3>
                            <p class="text-slate-500 text-sm">{{ $jobCandidate->profile->occupation}} - {{ $jobCandidate->profile->experience}}yrs </p>
                        </div>
                    </div>

                    @if($jobCandidate->is_hired == 'hired')
                    <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-green-500 text-white">
                        HIRED
                    </span>
                    @elseif($jobCandidate->is_hired == 'waiting')
                    <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-orange-500 text-white">
                        WAITING
                    </span>
                    @elseif($jobCandidate->is_hired == 'rejected')
                    <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-red-500 text-white">
                        REJECTED
                    </span>
                    @endif


                </div>
                
                <div class="flex flex-col gap-y-3">
                    <h3 class="text-indigo-950 text-xl font-bold mt-5">Message</h3>
                <p>
                    {{ $jobCandidate->message }}
                </p>
                </div>

                <div class="flex flex-col gap-y-3 mt-5">
                    <h3 class="text-indigo-950 text-xl font-bold">CV</h3>
                    <a href="{{ asset('storage/' . $jobCandidate->resume) }}" target="_blank" rel="noopener noreferrer" class="bg-gray-100 p-4 rounded-lg shadow-md flex items-center justify-between hover:bg-gray-200 transition duration-300 ease-in-out">
                        <span class="text-indigo-950 font-bold">Lihat CV</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m0 0h6m-6 0v6m0-6V6a2 2 0 012-2h10a2 2 0 012 2v10a2 2 0 01-2 2H9a2 2 0 01-2-2v-6z" />
                        </svg>
                    </a>
                </div>
                

                @if ($jobCandidate->is_hired != 'hired')
                <div class="flex flex-col gap-y-3 mt-5">
                    <h3 class="text-indigo-950 text-xl font-bold">Ubah CV</h3>
                    <form action="{{ route('dashboard.my.application.update', $jobCandidate->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-100 p-5 rounded-lg shadow-md">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="resume" class="block text-gray-700 text-sm font-bold mb-2">Upload CV Baru:</label>
                            <input type="file" name="resume" id="resume" class="border border-gray-300 rounded-md p-2 w-full">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-4 rounded-md hover:bg-indigo-500 transition duration-300 ease-in-out">
                                Ubah
                            </button>
                        </div>
                    </form>
                </div>
                
                @endif
                @if($jobCandidate->is_hired == 'hired')
    <hr class="my-5">
    <h3 class="text-indigo-950 text-xl font-bold">Congrats! Anda terpilih bekerja</h3>
    <p>
        Anda akan segera mendapatkan instruksi selanjutnya dari perusahaan terkait workflow pekerjaan. Silahkan periksa email Anda secara berkala. Have a great career!
    </p>
@elseif($jobCandidate->is_hired == 'rejected')
    <hr class="my-5">
    <h3 class="text-indigo-950 text-xl font-bold">Sorry! Anda belum beruntung</h3>
    <p>
        Silahkan mencoba apply pada pekerjaan lainnya yang tersedia!
    </p>
    <p>
        <a href="{{ route('frontend.index') }}" class="font-bold py-3 px-10 rounded-full bg-indigo-700 text-white">
        Explore Jobs</a>
    </p>
@endif

                
            </div>
        </div>
    </div>
</x-app-layout>