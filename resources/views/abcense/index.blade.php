<x-app-layout>
    <div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-900 shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Liste des Absences</h2>

        @if($absences->isEmpty())
            <p class="text-gray-600 dark:text-gray-300">Aucune absence ajoutée.</p>
            @if (auth()->user()->role === 'prof')
                <a href="{{ route('absences.create') }}" 
                   class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-400">
                   Ajouter une Absence
                </a>
            @endif
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white">
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Date</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Séance</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Nom de l'Étudiant</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Statut</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Raison</th>
                            @if (auth()->user()->role === 'prof')
                                <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absences as $absence)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-900 dark:text-white">
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $absence->date_absence }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">Séance {{ $absence->scence }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $absence->student->name }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                <span class="{{ $absence->si_present ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                    {{ $absence->si_present ? 'Présent' : 'Absent' }}
                                </span>
                            </td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                                {{ $absence->reason ?? 'Aucun motif' }}
                            </td>
                            @if (auth()->user()->role === 'prof')  
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                <a href="{{ route('absences.edit', $absence->id) }}" 
                                   class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                                   Modifier
                                </a>
                                <form action="{{ route('absences.destroy', $absence->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette absence ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                            @endif   
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (auth()->user()->role === 'prof')
                <div class="mt-4">
                    <a href="{{ route('absences.create') }}" 
                       class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-400">
                       Ajouter une Absence
                    </a>
                </div>
            @endif
        @endif
    </div>
</x-app-layout>
