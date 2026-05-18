<?php

namespace App\Http\Controllers;

use App\Models\MedicalVisit;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalVisitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, int $pet_id)
    {
        $pet = Pet::with('medicalVisits')->findOrFail($pet_id);
        if (Auth::id() != $pet->user_id) {
            abort(403, 'No tienes permisos para ver esta página');
        }
        return view('medical_visits.index')->with('pet', $pet);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, int $pet_id)
    {
        $pet = Pet::with('medicalVisits')->findOrFail($pet_id);
        if (Auth::id() != $pet->user_id) {
            abort(403, 'No tienes permisos para ver esta página');
        }
        return view('medical_visits.create')->with('pet', $pet);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, int $pet_id)
    {
        $pet = Pet::findOrFail($pet_id);
        if (Auth::id() != $pet->user_id) {
            abort(403, 'No tienes permisos para ver esta página');
        }
        $validated = $request->validate([
            'visit_date' => 'required|date',
            'reason' => 'required|string|max:255',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);
        $validated['pet_id'] = $pet->id;
        MedicalVisit::create($validated);
        return redirect()->route('medical-visits.index', $pet->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
