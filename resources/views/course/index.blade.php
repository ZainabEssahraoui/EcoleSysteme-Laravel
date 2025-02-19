<x-app-layout>

    <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Courses List</h1>

        @if ($courses->isEmpty())
            <p class="text-gray-600 dark:text-gray-300 mb-4">No courses found.</p>
            <a href="{{ route('courses.create') }}" 
               class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition dark:bg-indigo-500 dark:hover:bg-indigo-600">
                Add New Course
            </a>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr class="text-gray-700 dark:text-gray-300">
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Title</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Module</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Student</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">File</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr class="text-gray-700 dark:text-gray-300 text-center border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $course->title }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $course->module->name ?? 'No Module' }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $course->student->name ?? 'No Student' }}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                    @if ($course->file_path)
                                        <a href="{{ asset('storage/' . $course->file_path) }}" target="_blank" 
                                           class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                            View File
                                        </a>
                                    @else
                                        <span class="text-gray-500 dark:text-gray-400">No File</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                    <div class="flex space-x-2 justify-center">
                                        <a href="{{ route('courses.show', $course->id) }}" 
                                           class="bg-blue-500 dark:bg-blue-600 text-white py-1 px-3 rounded-lg text-sm hover:bg-blue-600 dark:hover:bg-blue-700 transition">
                                            View
                                        </a>
                                        <a href="{{ route('courses.edit', $course->id) }}" 
                                           class="bg-yellow-500 dark:bg-yellow-600 text-white py-1 px-3 rounded-lg text-sm hover:bg-yellow-600 dark:hover:bg-yellow-700 transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="bg-red-500 dark:bg-red-600 text-white py-1 px-3 rounded-lg text-sm hover:bg-red-600 dark:hover:bg-red-700 transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <a href="{{ route('courses.create') }}" 
                   class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition dark:bg-indigo-500 dark:hover:bg-indigo-600">
                    Add New Course
                </a>
            </div>
        @endif
    </div>

</x-app-layout>
