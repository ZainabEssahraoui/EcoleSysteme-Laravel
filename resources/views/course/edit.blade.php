<x-app-layout>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Edit Course</h1>
    
        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
    
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold">Title:</label>
                <input type="text" name="title" value="{{ $course->title }}" required 
                       class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded-lg focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-white">
            </div>
    
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold">Description:</label>
                <textarea name="description" required 
                          class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded-lg focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-white">{{ $course->description }}</textarea>
            </div>
    
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold">Module:</label>
                <select name="module_id" required 
                        class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded-lg focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-white">
                    @foreach($modules as $module)
                        <option value="{{ $module->id }}" {{ $module->id == $course->module_id ? 'selected' : '' }}>
                            {{ $module->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <label class="block text-gray-700 dark:text-gray-300 font-semibold">Upload File (Leave blank to keep existing file):</label>
                <input type="file" name="file" 
                       class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded-lg focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-white">
            </div>
    
            @if($course->file_path)
                <p class="text-gray-600 dark:text-gray-400">
                    Current file: 
                    <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank" 
                       class="text-indigo-600 dark:text-indigo-400 hover:underline">
                        View File
                    </a>
                </p>
            @endif
    
            <div class="flex space-x-4">
                <button type="submit" 
                        class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition">
                    Update Course
                </button>
                <a href="{{ route('courses.index') }}" 
                   class="w-full text-center bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
    
    </x-app-layout>
    