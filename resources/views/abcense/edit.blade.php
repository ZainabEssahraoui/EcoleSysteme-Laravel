<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-900 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
            Modifier l'Absence pour le Groupe : {{ $absence->group->name }}
        </h2>

        <form method="POST" action="{{ route('absences.update', $absence->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Séance -->
            <div>
                <label for="scence" class="block text-gray-700 dark:text-gray-300">Séance :</label>
                <select id="scence" name="scence" required class="w-full p-2 border rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white">
                    <option value="">-- Sélectionner une séance --</option>
                    <option value="1" {{ $absence->scence == 1 ? 'selected' : '' }}>Séance 1</option>
                    <option value="2" {{ $absence->scence == 2 ? 'selected' : '' }}>Séance 2</option>
                    <option value="3" {{ $absence->scence == 3 ? 'selected' : '' }}>Séance 3</option>
                    <option value="4" {{ $absence->scence == 4 ? 'selected' : '' }}>Séance 4</option>
                </select>
            </div>

            <!-- Date d'Absence -->
            <div>
                <label for="date_absence" class="block text-gray-700 dark:text-gray-300">Date d'Absence :</label>
                <input type="date" id="date_absence" name="date_absence" value="{{ $absence->date_absence }}" required 
                       class="w-full p-2 border rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white">
            </div>

            <!-- Tableau -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white">
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Nom de l'Étudiant</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Absence</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Motif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-white">
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                {{ $absence->student->name }}
                                <input type="hidden" name="student_id" value="{{ $absence->student->id }}">
                            </td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                <input type="checkbox" name="si_present" value="0" {{ !$absence->si_present ? 'checked' : '' }} 
                                       class="w-5 h-5">
                            </td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                <textarea name="reason" rows="2" class="w-full p-2 border rounded-lg bg-gray-100 dark:bg-gray-800 dark:text-white">{{ $absence->reason }}</textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Bouton de soumission -->
            <div class="mt-4">
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-400">
                    Mettre à Jour l'Absence
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
