<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Details') }}
            </h2>
            <a href="{{ route('company_users.index') }}" class="font-bold py-4 px-6 bg-gray-700 text-white rounded-full">
                Back to List
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-8">
                <!-- Name Section -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                </div>
    
                <!-- Email Section -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-gray-900">{{ $user->email }}</p>
                </div>
    
                <!-- Roles Section -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700">Roles</label>
                    <p class="mt-1 text-gray-900">
                        @foreach ($user->roles as $role)
                            {{ $role->name }}@if (!$loop->last), @endif
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
