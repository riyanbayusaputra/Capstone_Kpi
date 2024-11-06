<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Candidate Status') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <form method="POST" action="{{ route('admin.job_candidates.update', $jobCandidate->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="is_hired" class="block text-gray-700">Status</label>
                        <select id="is_hired" name="is_hired" class="w-full mt-1 p-2 border rounded">
                            <option value="hired" {{ $jobCandidate->is_hired == 'hired'? 'selected' : '' }}>Hired</option>
                            <option value="waiting" {{ $jobCandidate->is_hired == 'waiting'? 'selected' : '' }}>Waiting</option>
                            <option value="rejected" {{ $jobCandidate->is_hired == 'rejected'? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('is_hired')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
