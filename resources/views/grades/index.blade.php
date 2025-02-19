<x-app-layout>
   
    <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mt-10">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Grades</h1>
        @if (auth()->user()->role === 'prof')
        <div class="flex justify-between mb-4">
            <a href="{{ route('grades.export') }}" 
               class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition">
                Export to Excel
            </a>
        
            <form action="{{ route('grades.import') }}" method="POST" enctype="multipart/form-data" class="flex space-x-2">
                @csrf
                <input type="file" name="file" class="border p-2 rounded-lg" required>
                <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition">
                    Import from Excel
                </button>
            </form>
        </div>
        @else
        <a href="{{ route('grades.pdf') }}" 
   class="bg-blue-600 dark:bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition">
    Export PDF
</a>

        @endif
        
        @if ($grades->isEmpty())
            <p class="text-gray-600 dark:text-gray-400">No grades found.</p>
            @if (auth()->user()->role === 'prof')
            <a href="{{ route('grades.create') }}" class="bg-blue-600 dark:bg-blue-700 text-white py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">Add New Grade</a>
            @endif
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-md">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="py-3 px-4 border-b dark:border-gray-600">Student</th>
                            <th class="py-3 px-4 border-b dark:border-gray-600">Module</th>
                            <th class="py-3 px-4 border-b dark:border-gray-600">Grade</th>
                            <th class="py-3 px-4 border-b dark:border-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grades as $grade)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="py-3 px-4 text-gray-900 dark:text-gray-200">{{ $grade->student->name }}</td>
                                <td class="py-3 px-4 text-gray-900 dark:text-gray-200">{{ $grade->module->name }}</td>
                                <td class="py-3 px-4 font-semibold text-gray-900 dark:text-gray-200">{{ $grade->grade }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('grades.show', $grade->id) }}" class="bg-blue-500 dark:bg-blue-600 text-white py-1 px-3 rounded-lg text-sm hover:bg-blue-600 dark:hover:bg-blue-700 transition">View</a>
                                        @if (auth()->user()->role === 'prof')
                                            <a href="{{ route('grades.edit', $grade->id) }}" class="bg-yellow-500 dark:bg-yellow-600 text-white py-1 px-3 rounded-lg text-sm hover:bg-yellow-600 dark:hover:bg-yellow-700 transition">Edit</a>
                                            <form action="{{ route('grades.destroy', $grade->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 dark:bg-red-600 text-white py-1 px-3 rounded-lg text-sm hover:bg-red-600 dark:hover:bg-red-700 transition">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    
            @if (auth()->user()->role === 'prof')
            <div class="mt-4">
                <a href="{{ route('grades.create') }}" class="bg-blue-600 dark:bg-blue-700 text-white py-2 px-4 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition">Add New Grade</a>
            </div>
            @endif
        @endif
    </div>
    </x-app-layout>
    