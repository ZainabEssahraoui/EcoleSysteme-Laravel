<nav>
    <ul>
        @if(Auth::user()->role === 'student')
            <li><a href="{{ route('courses.index') }}">Mes Cours</a></li>
            <li><a href="{{ route('student.grades.index') }}">Mes Notes</a></li>
            <li><a href="{{ route('student.absences.index') }}">Mes absences</a></li>
            


        @elseif(Auth::user()->role === 'prof')
            <li><a href="{{ route('grades.index') }}">Gestion des Notes</a></li>
            <li><a href="{{ route('absences.index') }}">Marquage des Absences</a></li>
        @endif
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Se Déconnecter</button>
            </form>
        </li>
    </ul>
</nav>


