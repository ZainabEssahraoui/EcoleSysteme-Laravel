<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absence;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     * Shows only absences that belong to the logged-in professor.
     */
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user is a professor
        if ($user->role !== 'prof') {
            abort(403, 'Unauthorized action.');
        }

        // Fetch absences where the logged-in user is the professor
        $absences = Absence::where('prof_id', $user->id)
                            ->with(['student', 'group'])
                            ->get();

        return view('abcense.index', compact('absences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = User::where('role', 'student')->get();
        $groups = Group::all();
        $prof_id = Auth::id(); // Automatically assign the logged-in professor

        return view('abcense.create', compact('students', 'groups', 'prof_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'group_id' => 'required|exists:groups,id',
            'heure_debut_scence' => 'required|date_format:H:i',
            'heure_fin_scence' => 'required|date_format:H:i|after:heure_debut_scence',
            'si_present' => 'boolean',
            'reason' => 'nullable|string',
        ]);

        // Assign the logged-in professor's ID automatically
        $validated['prof_id'] = Auth::id();

        Absence::create($validated);

        return redirect()->route('absences.index')->with('success', 'Absence recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $absence = Absence::findOrFail($id);

        // Ensure the professor is only viewing their own absences
        if ($absence->prof_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('absences.show', compact('absence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $absence = Absence::findOrFail($id);

        // Ensure the professor is editing their own absence
        if ($absence->prof_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $students = User::where('role', 'student')->get();
        $groups = Group::all();

        return view('abcense.edit', compact('absence', 'students', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $absence = Absence::findOrFail($id);

        // Ensure the professor is updating their own absence
        if ($absence->prof_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'group_id' => 'required|exists:groups,id',
            'heure_debut_scence' => 'required|date_format:H:i',
            'heure_fin_scence' => 'required|date_format:H:i|after:heure_debut_scence',
            'si_present' => 'boolean',
            
        ]);

        $absence->update($validated);

        return redirect()->route('absences.index')->with('success', 'Absence updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $absence = Absence::findOrFail($id);

        // Ensure the professor is deleting their own absence
        if ($absence->prof_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $absence->delete();

        return redirect()->route('absences.index')->with('success', 'Absence deleted successfully.');
    }
}
