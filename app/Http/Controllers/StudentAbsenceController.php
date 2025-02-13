<?php
namespace App\Http\Controllers;

use App\Models\Absence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceStudentController extends Controller
{
    /**
     * Display the list of absences for the logged-in student.
     */
    public function index()
    {
        $user = Auth::user();
        $absences = Absence::where('student_id', $user->id)
            ->with('module')
            ->get();

        return view('absenceStudent.index', compact('absences'));
    }

    /**
     * Show a specific absence for the student.
     */
    public function show($id)
    {
        $absence = Absence::findOrFail($id);
        $user = Auth::user();

        if ($absence->student_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('absenceStudent.show', compact('absence'));
    }
}
