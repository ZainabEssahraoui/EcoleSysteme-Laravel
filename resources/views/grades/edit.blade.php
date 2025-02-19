<x-app-layout>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Edit Grade</h1>
    
        @if ($errors->any())
            <div class="bg-red-100 dark:bg-red-700 text-red-700 dark:text-red-200 p-4 mb-4 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form action="{{ route('grades.update', $grade->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
    
            <div>
                <label for="student_id" class="block text-gray-700 dark:text-gray-300 font-medium">Student</label>
                <select name="student_id" id="student_id" 
                        class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded-lg focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-white" 
                        required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" {{ $student->id == $grade->student_id ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <label for="module_id" class="block text-gray-700 dark:text-gray-300 font-medium">Module</label>
                <select name="module_id" id="module_id" 
                        class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded-lg focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-white" 
                        required>
                    @foreach ($modules as $module)
                        <option value="{{ $module->id }}" {{ $module->id == $grade->module_id ? 'selected' : '' }}>
                            {{ $module->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div>
                <label for="grade" class="block text-gray-700 dark:text-gray-300 font-medium">Grade</label>
                <input type="number" name="grade" id="grade" 
                       class="w-full border border-gray-300 dark:border-gray-600 p-2 rounded-lg focus:ring focus:ring-indigo-200 dark:bg-gray-700 dark:text-white" 
                       value="{{ $grade->grade }}" min="0" max="20" step="0.01" required>
            </div>
    
            <div class="flex space-x-4 mt-4">
                <button type="submit" class="bg-green-600 dark:bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-700 dark:hover:bg-green-600 transition">
                    Update
                </button>
                <a href="{{ route('grades.index') }}" 
                   class="bg-gray-600 dark:bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
    
    </x-app-layout>
    