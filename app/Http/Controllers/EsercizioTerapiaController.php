<?php

namespace App\Http\Controllers;

use App\Models\EsercizioTerapia;
use Illuminate\Http\Request;

/**
 * Inserisce un esercizio all'interno di una terapia
 * (table EsercizioTerapia)
 */
class EsercizioTerapiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $esercizioterapia = EsercizioTerapia::all();
        return $esercizioterapia;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dayofweek'=> 'required|max:255',
            'timeofday'=> 'required|max:255',
            'sequence'=> 'required|max:255',
            'Therapy_id'=>'required|integer|exists:App\Models\Terapia,id',
            'Exercise_idExercise'=> 'required|integer|exists:App\Models\Esercizio,id',
        ]);
        $esercizioterapia = new EsercizioTerapia;
        $esercizioterapia->fill($validated);
        $esercizioterapia->save();
        return $esercizioterapia;
    }

    /**
     * Display the specified resource.
     */
    public function show(EsercizioTerapia $exercise_therapy)
    {
        return $exercise_therapy;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EsercizioTerapia $exercise_therapy)
    {
        $validated = $request->validate([
            'dayofweek'=> 'required|max:255',
            'timeofday'=> 'required|max:255',
            'sequence'=> 'required|max:255',
            'Therapy_id'=>'required|integer|exists:App\Models\Terapia,id',
            'Exercise_idExercise'=> 'required|integer|exists:App\Models\Esercizio,id',
        ]);
        $exercise_therapy = new EsercizioTerapia;
        $exercise_therapy->fill($validated);
        $exercise_therapy->save();
        return $exercise_therapy;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EsercizioTerapia $exercise_therapy)
    {
        $exercise_therapy->delete();
        return '{}';
    }
}
