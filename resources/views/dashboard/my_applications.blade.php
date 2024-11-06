<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Job Applications') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">

                @forelse($my_applications as $application)
                <div class="item-card flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($application->job->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">
                                {{ $application->job->name }}
                            </h3>
                            <p class="text-slate-500 text-sm">
                                {{ $application->job->category->name }}
                            </p>
                        </div>
                    </div> 
                    <div class="flex flex-col mt-4 md:mt-0">
                        <div class="md:hidden flex items-center gap-x-2">
                            <p class="text-slate-500 text-sm">Salary:</p>
                            <h3 class="text-indigo-950 text-xl font-bold">
                                {{($application->job->salary) }}
                            </h3>
                        </div>
                        <div class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Salary</p>
                            <h3 class="text-indigo-950 text-xl font-bold">
                                {{($application->job->salary) }}/mo
                            </h3>
                        </div>
                    </div>
                    <div class="flex flex-col mt-4 md:mt-0">
                       
                        <div class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Status:</p>
                            @if($application->is_hired == 'hired')
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-green-500 text-white">
                                HIRED
                            </span>
                            @elseif($application->is_hired == 'waiting')
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-orange-500 text-white">
                                WAITING
                            </span>
                            @elseif($application->is_hired == 'rejected')
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-red-500 text-white">
                                REJECTED
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('dashboard.my.application.details', $application) }}" class="font-bold py-3 px-5 bg-indigo-700 text-white rounded-full">
                            View Details
                        </a>
                    </div>
                </div>
                @empty
                <p>
                    <a href="{{ route('frontend.index') }}" class="py-3 px-10 bg-indigo-500 text-white">
                        Explore Jobs
                    </a>
                </p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
