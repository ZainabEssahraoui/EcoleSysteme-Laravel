<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\User;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;


class GradeController extends Controller
{
    /**
     * Display a listing of the grades.
     */

     
     
     
     public function exportPDF()
     {
         $grades = Grade::where('student_id', Auth::id())->with('module')->get();
         
         $pdf = Pdf::loadView('grades.pdf', compact('grades'));
         
         return $pdf->download('student_grades.pdf');
     }
public function export()
{
    $grades = Grade::with(['student', 'module'])->get();

    $writer = WriterEntityFactory::createXLSXWriter();
    $filePath = storage_path('grades.xlsx');

    $writer->openToFile($filePath);

    // Ajouter les en-têtes
    $headerRow = WriterEntityFactory::createRowFromArray(['Student', 'Module', 'Grade']);
    $writer->addRow($headerRow);

    // Ajouter les données
    foreach ($grades as $grade) {
        $row = WriterEntityFactory::createRowFromArray([
            $grade->student->name,
            $grade->module->name,
            $grade->grade
        ]);
        $writer->addRow($row);
    }

    $writer->close();

    return Response::download($filePath)->deleteFileAfterSend(true);
}

     
     public function import(Request $request)
     {
         $request->validate([
             'file' => 'required|mimes:xlsx,csv'
         ]);
     
         $filePath = $request->file('file')->store('temp');
         $fullPath = storage_path('app/' . $filePath);
     
         $reader = ReaderEntityFactory::createReaderFromFile($fullPath);
         $reader->open($fullPath);
     
         foreach ($reader->getSheetIterator() as $sheet) {
             foreach ($sheet->getRowIterator() as $index => $row) {
                 if ($index === 1) continue; // Ignore l'en-tête
     
                 $cells = $row->toArray();
                 $student = User::where('name', $cells[0])->first();
                 $module = Module::where('name', $cells[1])->first();
     
                 if ($student && $module) {
                     Grade::create([
                         'student_id' => $student->id,
                         'module_id' => $module->id,
                         'grade' => (float) $cells[2],
                         'prof_id' => Auth::id(),
                     ]);
                 }
             }
         }
     
         $reader->close();
         Storage::delete($filePath);
     
         return redirect()->route('grades.index')->with('success', 'Grades imported successfully.');
     }
     

    public function index()
    {
        if (Auth::user()->role === 'student') {
            $grades = Grade::where('student_id', Auth::id())->with('module')->get();
        } else {
            $grades = Grade::with(['student', 'module'])->get();
        }
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
            'grade' => 'required|numeric|min:0|max:20', 
        ]);
        $validated['prof_id'] = Auth::id();

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
        $validated['prof_id'] = Auth::id();

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
