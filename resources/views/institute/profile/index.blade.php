@extends('institute.layouts.master')

@section('title', 'Profile')

@section('content')
<div class="container mx-auto">
    <div class="flex flex-col gap-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">Profile</h1>
        </div>

        <!-- Profile Form -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <form action="{{ route('institute.profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                        <div class="px-6 py-4 border-b">
                            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
                            <p class="mt-1 text-sm text-gray-500">Update your institute's profile information.</p>
                        </div>
                        <div class="px-6 py-4 space-y-6">
                            <!-- Institute Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Institute Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', auth()->guard('institute')->user()->name) }}"
                                       class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email', auth()->guard('institute')->user()->email) }}"
                                       class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Responsible Person Name -->
                            <div>
                                <label for="responsible_person_name" class="block text-sm font-medium text-gray-700">Responsible Person Name</label>
                                <input type="text" name="responsible_person_name" id="responsible_person_name" 
                                       value="{{ old('responsible_person_name', auth()->guard('institute')->user()->responsible_person_name) }}"
                                       class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('responsible_person_name') border-red-500 @enderror">
                                @error('responsible_person_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Responsible Person Phone -->
                            <div>
                                <label for="responsible_person_phone" class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text" name="responsible_person_phone" id="responsible_person_phone" 
                                       value="{{ old('responsible_person_phone', auth()->guard('institute')->user()->responsible_person_phone) }}"
                                       class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('responsible_person_phone') border-red-500 @enderror">
                                @error('responsible_person_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-gray-50">
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Account Actions -->
            <div class="lg:col-span-1">
                <div class="overflow-hidden bg-white rounded-lg shadow-sm">
                    <div class="px-6 py-4 border-b">
                        <h2 class="text-lg font-medium text-gray-900">Account Actions</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Contact Support -->
                            <button class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                    Contact Support
                                </span>
                                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>

                            <!-- Delete Account -->
                            <button class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-red-700 bg-red-50 rounded-lg hover:bg-red-100">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-3 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    Delete Account
                                </span>
                                <svg class="w-5 h-5 text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
