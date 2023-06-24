<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Record;
use App\Models\User;
class RecordController extends Controller
{
    public function index()
    {
        // Retrieve all records
        $records = Record::all();

        return response()->json($records);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'full_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'mobile' => 'required',
            'address' => 'required',
            'name' => 'required',
            'role_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6', // Added password validation
        ]);
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role_name' => $validatedData['role_name'],
        ]);
        // Create a new record using the validated data
        $record = Record::create($validatedData);

        return response()->json(['message' => 'Record created successfully', 'record' => $record], 201);
    }

    public function destroy($id)
    {
        $record = Record::findOrFail($id);
        $record->delete();
        return response()->json(['message' => 'Record deleted successfully']);
    }
}
