<x-app-layout>
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 mt-10">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Grade Details</h1>
    
        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow-md">
            <h5 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                Student: <span class="text-blue-600 dark:text-blue-400">{{ $grade->student->name }}</span>
            </h5>
            <h6 class="text-md text-gray-600 dark:text-gray-300 mt-2">
                Module: <span class="font-medium">{{ $grade->module->name }}</span>
            </h6>
            <p class="mt-4 text-lg">
                Grade: <strong class="text-green-600 dark:text-green-400">{{ $grade->grade }}</strong>
            </p>
        </div>
    
        <a href="{{ route('grades.index') }}" 
           class="mt-6 inline-block bg-blue-600 dark:bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition">
            Back to List
        </a>
    </div>
    </x-app-layout>
    