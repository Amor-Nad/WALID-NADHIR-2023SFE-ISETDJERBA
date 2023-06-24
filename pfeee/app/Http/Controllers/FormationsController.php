<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudentFormation;

class FormationsController extends Controller
{
    public function index()
    {
        $formations = Formation::all();

        return response()->json($formations);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'formation_name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'teacher_id' => 'required', 
        ]);
    
        $formation = Formation::create($validatedData);
    
        return response()->json($formation, 200);
    }
    
    public function getTeachers()
    {
        $teachers = User::where('role_name', 'Teacher')->get();
    
        return response()->json(['teachers' => $teachers], 200);
    }
    public function getStudents()
    {
        $students = User::where('role_name', 'Student')->get();
    
        return response()->json(['students' => $students], 200);
    }


    public function show($id)
    {
        $formation = Formation::find($id);

        if (!$formation) {
            return response()->json(['message' => 'Formation not found'], 404);
        }

        return response()->json($formation);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'formation_name' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $formation = Formation::find($id);

        if (!$formation) {
            return response()->json(['message' => 'Formation not found'], 404);
        }

        $formation->update($validatedData);

        return response()->json($formation, 200);
    }

    


    public function destroy($id)
    {
        $formation = Formation::find($id);

        if (!$formation) {
            return response()->json(['message' => 'Formation not found'], 404);
        }

        $formation->delete();

        return response()->json(['message' => 'Formation deleted successfully']);
    }


    
    public function getAssignedFormations()
    {
        $assignedFormations = Formation::whereNotNull('teacher_id')->get();
        return response()->json($assignedFormations, 200);
    }


public function formations()
{
    return $this->hasMany(Formation::class, 'teacher_id');
}
public function enroll(Request $request)
{
    $validatedData = $request->validate([
        'formation_id' => 'required|exists:formations,id',
        // Add any other validation rules as needed
    ]);

    // Get the authenticated student or use your own logic to retrieve the student record
    $student = auth()->user();

    // Check if the student is already enrolled in the formation
    $isEnrolled = StudentFormation::where('formation_id', $validatedData['formation_id'])
        ->where('student_id', $student->id)
        ->exists();

    if ($isEnrolled) {
        // Student is already enrolled, handle the response accordingly
        return response()->json(['message' => 'Student is already enrolled in the formation'], 400);
    }

    // Create a new enrollment record
    StudentFormation::create([
        'formation_id' => $validatedData['formation_id'],
        'student_id' => $student->id,
        // Add any other relevant data for enrollment, such as enrollment date, etc.
    ]);

    // Handle the successful enrollment response
    return response()->json(['message' => 'Enrollment successful'], 200);
}

}
