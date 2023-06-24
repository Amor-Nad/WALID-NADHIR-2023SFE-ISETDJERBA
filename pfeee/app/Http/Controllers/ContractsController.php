<?php

// app/Http/Controllers/ContractsController.php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Formation;
use Illuminate\Http\Request;

class ContractsController extends Controller
{
    public function create()
    {
        $formations = Formation::all();

        return view('contracts.create', compact('formations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'formation_id' => 'required|exists:formations,id',
            'teacher_name' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required|numeric',
        ]);

        Contract::create($request->all());

        return redirect()->route('contracts.create')->with('success', 'Contract created successfully.');
    }
    public function index()
    {
        $contracts = Contract::with('formation', 'teacher')->get();

        return response()->json($contracts);
    }
}
