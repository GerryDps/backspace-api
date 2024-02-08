<?php

namespace App\Http\Controllers;

use App\Models\Completato;
use Illuminate\Http\Request;

/**
 * Il paziente puo marcare un esercizio presente in una sua terapia
 * come COMPLETATO. verrà salvata la data di completamento
 */

class CompletatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $completato = Completato::all();
        return $completato;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $completato = new Completato;

        $validated = $request->validate([
            'data' => 'required|date',
            'pazienteterapia_paziente_id'=> 'required|integer|exists:App\Models\PazienteTerapia,id',
            'terapia_terapia_id'=>'required|integer|exists:App\Models\Terapia,id',
            'esercizioterapia_esercizio_idesercizio'=> 'required|integer|exists:App\Models\EsercizioTerapia,id',
        ]);
 
        $completato->fill($validated);
 
        $completato->save();
        return $completato;
    }

    /**
     * Display the specified resource.
     */
    public function show(Completato $completato)
    {
        return $completato;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Completato $completato)
    {
        $validated = $request->validate([
            'data' => 'required|date',
            // non avrebbe senso effettuare l'update di questi campi. al massimo la data di completamento
            //'pazienteterapia_paziente_id'=> 'required|integer|exists:App\Models\PazienteTerapia,id',
            //'terapia_terapia_id'=>'required|integer|exists:App\Models\Terapia,id',
            //'esercizioterapia_esercizio_idesercizio'=> 'required|integer|exists:App\Models\EsercizioTerapia,id',
        ]);
 
        $completato->data = $validated['data'];
 
        $completato->save();
        return $completato;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Completato $completato)
    {
        $completato->delete();
        return $completato;
    }
}
