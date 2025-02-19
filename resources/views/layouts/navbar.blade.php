<nav class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            <!-- Liens de Navigation -->
            <div class="hidden sm:flex sm:space-x-8 sm:items-center">
                @if(Auth::user()->role === 'student')
                    <a href="{{ route('courses.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Mes Cours
                    </a>
                    <a href="{{ route('student.grades.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Mes Notes
                    </a>
                    <a href="{{ route('student.absences.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Mes Absences
                    </a>
                @elseif(Auth::user()->role === 'prof')
                    <a href="{{ route('grades.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Gestion des Notes
                    </a>
                    <a href="{{ route('absences.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Marquage des Absences
                    </a>
                @endif
            </div>

            <!-- Bouton de Déconnexion -->
            <div class="hidden sm:flex sm:items-center">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                        Se Déconnecter
                    </button>
                </form>
            </div>

            <!-- Menu Hamburger (Mobile) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Ouvrir le menu</span>
                    <!-- Icône du menu hamburger -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu Responsive (Mobile) -->
    <div x-show="open" class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::user()->role === 'student')
                <a href="{{ route('courses.index') }}" class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">
                    Mes Cours
                </a>
                <a href="{{ route('student.grades.index') }}" class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">
                    Mes Notes
                </a>
                <a href="{{ route('student.absences.index') }}" class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">
                    Mes Absences
                </a>
            @elseif(Auth::user()->role === 'prof')
                <a href="{{ route('grades.index') }}" class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">
                    Gestion des Notes
                </a>
                <a href="{{ route('absences.index') }}" class="text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">
                    Marquage des Absences
                </a>
            @endif
        </div>

        <!-- Bouton de Déconnexion (Mobile) -->
        <div class="pt-4 pb-3 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-gray-700 hover:text-gray-900 block px-3 py-2 rounded-md text-base font-medium">
                    Se Déconnecter
                </button>
            </form>
        </div>
    </div>
</nav>