<?php
namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeStudentController extends Controller
{
    /**
     * Display the list of grades for the logged-in student.
     */
    public function index()
    {
        $user = Auth::user();
        $grades = Grade::where('student_id', $user->id)
            ->with('module')
            ->get();

        return view('gradeStudent.index', compact('grades'));
    }

    /**
     * Show a specific grade for the student.
     */
    public function show($id)
    {
        $grade = Grade::findOrFail($id);
        $user = Auth::user();

        if ($grade->student_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('gradeStudent.show', compact('grade'));
    }
}
