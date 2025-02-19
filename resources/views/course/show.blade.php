<x-app-layout>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">{{ $course->title }}</h1>
    
        <div class="mb-4">
            <p class="text-gray-700 dark:text-gray-300"><strong>Description:</strong> {{ $course->description }}</p>
            <p class="text-gray-700 dark:text-gray-300"><strong>Module:</strong> {{ $course->module->name }}</p>
            <p class="text-gray-700 dark:text-gray-300"><strong>Student:</strong> {{ $course->student->name }}</p>
        </div>
    
        @if($course->file_path)
            <p class="mb-4 text-gray-700 dark:text-gray-300">
                <strong>File:</strong> 
                <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank" 
                   class="text-indigo-600 dark:text-indigo-400 hover:underline">
                    View File
                </a>
            </p>
        @else
            <p class="text-gray-500 dark:text-gray-400">No file uploaded.</p>
        @endif
    
        <div class="flex space-x-4 mt-6">
            <a href="{{ route('courses.edit', $course->id) }}" 
               class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 transition">
                Edit Course
            </a>
    
            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition">
                    Delete
                </button>
            </form>
    
            <a href="{{ route('courses.index') }}" 
               class="bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 dark:bg-gray-500 dark:hover:bg-gray-600 transition">
                Back to List
            </a>
        </div>
    </div>
    
    </x-app-layout>
    