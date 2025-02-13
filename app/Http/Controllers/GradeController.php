<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\User;
use App\Models\Module;

class GradeController extends Controller
{
    /**
     * Display a listing of the grades.
     */
    public function index()
    {
        $grades = Grade::with(['student', 'module'])->get();
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new grade.
     */
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $modules = Module::all();

        return view('grades.create', compact('students', 'modules'));
    }

    /**
     * Store a newly created grade in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'module_id' => 'required|exists:modules,id',
            'grade' => 'required|numeric|min:0|max:20', // Grades between 0 and 20
        ]);

        Grade::create($validated);

        return redirect()->route('grades.index')->with('success', 'Grade recorded successfully.');
    }

    /**
     * Display the specified grade.
     */
    public function show(string $id)
    {
        $grade = Grade::with(['student', 'module'])->findOrFail($id);
        return view('grades.show', compact('grade'));
    }

    /**
     * Show the form for editing the specified grade.
     */
    public function edit(string $id)
    {
        $grade = Grade::findOrFail($id);
        $students = User::where('role', 'student')->get();
        $modules = Module::all();

        return view('grades.edit', compact('grade', 'students', 'modules'));
    }

    /**
     * Update the specified grade in storage.
     */
    public function update(Request $request, string $id)
    {
        $grade = Grade::findOrFail($id);

        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'module_id' => 'required|exists:modules,id',
            'grade' => 'required|numeric|min:0|max:20',
        ]);

        $grade->update($validated);

        return redirect()->route('grades.index')->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified grade from storage.
     */
    public function destroy(string $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully.');
    }
}
