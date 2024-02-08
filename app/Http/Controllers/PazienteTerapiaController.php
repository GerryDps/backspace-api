<?php

namespace App\Http\Controllers;

use App\Models\PazienteTerapia;
use Illuminate\Http\Request;

/**
 * Assegna una terapia ad un paziente
 * (table PazienteTerapia)
 */

class PazienteTerapiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pazienteTerapia = PazienteTerapia::all();
        return $pazienteTerapia;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'paziente_id'=>'required|integer|exists:App\Models\Paziente,id',
            'terapia_id'=>'required|integer|exists:App\Models\Terapia,id',
        ]);
        $pazienteTerapia = new PazienteTerapia;
        $pazienteTerapia->fill($validated);
        $pazienteTerapia->save();
        return $pazienteTerapia;
    }

    /**
     * Display the specified resource.
     */
    public function show(PazienteTerapia $pazienteTerapia)
    {
        return $pazienteTerapia;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PazienteTerapia $pazienteTerapia)
    {
        // Non avrebbe senso updatare questa relazione... delete() -> store()
        /* $validated = $request->validate([
            'paziente_id'=>['required|integer|exists:App\Models\Paziente,id'],
            'terapia_id'=>['required|integer|exists:App\Models\Terapia,id'],
        ]);
        $pazienteTerapia = new PazienteTerapia;
        $pazienteTerapia->fill($validated);
        $pazienteTerapia->save();
        return $pazienteTerapia; */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PazienteTerapia $pazienteTerapia)
    {
        $pazienteTerapia->delete();
        return '{}';
    }
}
