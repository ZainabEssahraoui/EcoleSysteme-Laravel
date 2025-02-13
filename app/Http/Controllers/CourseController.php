<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Module;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with(['module', 'student'])->get();
        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modules = Module::all();
        $students = User::where('role', 'student')->get();
        return view('course.create', compact('modules', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'module_id' => 'required|exists:modules,id',
            'student_id' => 'required|exists:users,id',
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        }

        Course::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'module_id' => $validated['module_id'],
            'student_id' => $validated['student_id'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::findOrFail($id)->load(['module', 'student']);
        return view('course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        $modules = Module::all();
        $students = User::where('role', 'student')->get();
        return view('course.edit', compact('course', 'modules', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'module_id' => 'required|exists:modules,id',
            'student_id' => 'required|exists:users,id',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $course = Course::findOrFail($id);
        $filePath = $course->file_path;

        if ($request->hasFile('file')) {
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        }

        $course->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'module_id' => $validated['module_id'],
            'student_id' => $validated['student_id'],
            'file_path' => $filePath,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $course = Course::findOrFail($id);

        if ($course->file_path && Storage::disk('public')->exists($course->file_path)) {
            Storage::disk('public')->delete($course->file_path);
        }

        $course->delete();
        return redirect()->route('course.index')->with('success', 'Course deleted successfully.');
    }
}
