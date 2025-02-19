<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-900 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
            Marquer l'Absence pour le Groupe : {{ $group->name }}
        </h2>

        <form method="POST" action="{{ route('absences.store') }}">
            @csrf

            <!-- Group ID (Hidden) -->
            <input type="hidden" name="group_id" value="{{ $group->id }}">

            <!-- Séance -->
            <div class="mb-4">
                <label for="scence" class="block text-gray-700 dark:text-gray-300 font-semibold">Séance :</label>
                <select id="scence" name="scence" required
                    class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white">
                    <option value="">-- Sélectionner une séance --</option>
                    <option value="1">Séance 1</option>
                    <option value="2">Séance 2</option>
                    <option value="3">Séance 3</option>
                    <option value="4">Séance 4</option>
                </select>
            </div>

            <!-- Date d'Absence -->
            <div class="mb-4">
                <label for="date_absence" class="block text-gray-700 dark:text-gray-300 font-semibold">Date d'Absence :</label>
                <input type="date" id="date_absence" name="date_absence" required
                    class="w-full mt-1 p-2 border border-gray-300 dark:border-gray-700 rounded bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white">
            </div>

            <!-- Tableau des étudiants -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white">
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Nom de l'Étudiant</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Absence</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Raison</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                        <tr class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                {{ $student->name }}
                                <input type="hidden" name="student_ids[]" value="{{ $student->id }}">
                            </td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                <input type="checkbox" name="si_present[{{ $student->id }}]" value="0" class="h-5 w-5">
                            </td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                <textarea name="reason[{{ $student->id }}]" rows="2"
                                    class="w-full p-2 border border-gray-300 dark:border-gray-600 rounded bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white"></textarea>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 dark:bg-blue-500 text-white rounded hover:bg-blue-700 dark:hover:bg-blue-400 transition">
                    Enregistrer les Absences
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
