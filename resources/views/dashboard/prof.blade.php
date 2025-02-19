<x-app-layout>

    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg mt-10">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Welcome, {{ $user->name }}</h1>
    
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
            <div class="p-4 border-b border-gray-200 dark:border-gray-600">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Profile</h2>
            </div>
            <div class="p-6">
                @if($user->image)
                    <div class="flex justify-center mb-4">
                        <img src="{{ asset('storage/'.$user->image) }}" alt="Profile Picture" 
                             class="w-24 h-24 rounded-full border-2 border-gray-300 dark:border-gray-500">
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400 text-center mb-4">No profile picture uploaded.</p>
                @endif
    
                <div class="space-y-3">
                    <p class="text-gray-600 dark:text-gray-300"><strong class="font-semibold">Name:</strong> {{ $user->name }}</p>
                    <p class="text-gray-600 dark:text-gray-300"><strong class="font-semibold">Email:</strong> {{ $user->email }}</p>
                    <p class="text-gray-600 dark:text-gray-300"><strong class="font-semibold">Role:</strong> {{ ucfirst($user->role) }}</p>
                </div>
            </div>
        </div>
    </div>
    
    </x-app-layout>
    