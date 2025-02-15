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
     */
    public function index()
    {
        // If the user is a student show only their absences
        if (Auth::user()->role === 'student') {
            $absences = Absence::where('student_id', Auth::id())->with(['student', 'group'])->get();
        } else {
            // Professors can see all absences
            $absences = Absence::with(['student', 'group'])->get();
        }
    
        return view('abcense.index', compact('absences'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $students = User::where('role', 'student')->get();
        $groups = Group::all();

        return view('abcense.create', compact('students', 'groups'));
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

        // Assign the logged-in professor's ID
        $validated['prof_id'] = Auth::id();

        // Create a new absence record
        Absence::create($validated);

        return redirect()->route('absences.index')->with('success', 'Absence recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Get a specific absence by ID
        $absence = Absence::findOrFail($id);

        return view('abcense.show', compact('absence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
  
        public function edit(string $id)
        {
            $absence = Absence::findOrFail($id);
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
        $validated = $request->validate([
            'student_id' => 'required|exists:users,id',
            'group_id' => 'required|exists:groups,id',
            'heure_debut_scence' => 'required|date_format:H:i',
            'heure_fin_scence' => 'required|date_format:H:i|after:heure_debut_scence',
            'si_present' => 'boolean',
            'reason' => 'nullable|string',
        ]);
        $validated['prof_id'] = Auth::id();

        $absence->update($validated);

        return redirect()->route('absences.index')->with('success', 'Absence updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $absence = Absence::findOrFail($id);
        $absence->delete();

        return redirect()->route('absences.index')->with('success', 'Absence deleted successfully.');
    }
}
