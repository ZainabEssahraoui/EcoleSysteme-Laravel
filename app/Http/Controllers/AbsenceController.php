<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Absence;


class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Check the role of the authenticated user
        if (Auth::user()->role === 'student') {
            // If the user is a student, show only their absences
            $absences = Absence::where('student_id', Auth::id())
                               ->with(['student', 'group'])
                               ->orderBy('date_absence', 'desc')
                               ->get();
        } else {
            // If the user is a professor, show only absences they recorded
            $profId = auth()->user()->id;
            $absences = Absence::where('prof_id', $profId)
                               ->with(['student', 'group'])
                               ->orderBy('date_absence', 'desc')
                               ->get();
        }
    
        return view('abcense.index', compact('absences'));
    }
      
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // afficher les student de professeur authentifier (son groupe)
        $profGroupId = Auth::user()->group_id;
        $students = User::where('role', 'student')->where('group_id', $profGroupId)->get();
        
        // Get the current professor's group
        $group = Group::find($profGroupId);
    
        return view('abcense.create', compact('students', 'group'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'group_id' => 'required|exists:groups,id',
        'scence' => 'required|in:1,2,3,4', 
        'date_absence' => 'required|date',
        'student_ids' => 'required|array',
        'si_present' => 'array',
        'reason' => 'array',
    ]);
    

    foreach ($validated['student_ids'] as $studentId) {
        Absence::create([
            'student_id' => $studentId,
            'group_id' => $validated['group_id'],
            'prof_id' => auth()->user()->id,
            'scence' => $validated['scence'],
            'date_absence' => $validated['date_absence'],
            'si_present' => isset($validated['si_present'][$studentId]) ? 0 : 1,
            'reason' => $validated['reason'][$studentId] ?? null,
        ]);
    }

    return redirect()->route('absences.index')->with('success', 'Absences enregistrées avec succès.');
}

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     */
  
     public function edit($id)
     {
        
         $absence = Absence::with(['student', 'group'])->findOrFail($id);
     
         // Check if the authenticated user is the professor who recorded this absence
         if ($absence->prof_id !== auth()->user()->id) {
             return redirect()->route('absences.index')->with('error', 'Vous n\'avez pas l\'autorisation de modifier cette absence.');
         }
     
         // Get all students in the group
         $students = User::where('group_id', $absence->group_id)->get();
     
         return view('abcense.edit', compact('absence', 'students'));
     }
     
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'scence' => 'required|in:1,2,3,4',
            'date_absence' => 'required|date',
            'student_id' => 'required|exists:users,id',
            'si_present' => 'nullable',  
            'reason' => 'nullable|string',
        ]);
    
        // Find the absence by ID
        $absence = Absence::findOrFail($id);
    
       
    
        // Update the absence record
        $absence->update([
            'scence' => $validated['scence'],
            'date_absence' => $validated['date_absence'],
            'si_present' => isset($validated['si_present']) ? 0 : 1,
            'reason' => $validated['reason'],
        ]);
    
        // Redirect back with success message
        return redirect()->route('absences.index')->with('success', 'Absence mise à jour avec succès.');
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