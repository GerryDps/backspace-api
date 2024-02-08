<?php

namespace App\Http\Controllers;

use App\Models\Terapia;
use App\Models\MedicoTerapia;
use Illuminate\Http\Request;

class TerapiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terapia = Terapia::all();
        return $terapia;
    }

    /**
     * Store a new terapy without medico_id only for internal use
     */
    protected function storeTerapia(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|unique:App\Models\Terapia,nome|max:255',
        ]);
        $terapia = new Terapia;

        $terapia->nome = $validated['nome'];
 
        $terapia->save();

        return $terapia;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|unique:App\Models\Terapia,nome|max:255',
            'medico_id' => 'required|exists:App\Models\Medico,id|integer',
        ]);
        $terapia = new Terapia;

        $terapia->nome = $validated['nome'];
 
        $terapia->save();
        /**
         * Creazione della relazione usando la table MedicoTerapia
         */
        $relazione = new MedicoTerapia;
        $relazione->medico_id = $validated['medico_id'];
        $relazione->terapia_id = $terapia->id;
        $relazione->save();

        return [$terapia,$relazione];
    }

    /**
     * Display the specified resource.
     */
    public function show(Terapia $terapia)
    {
        //
        return $terapia;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Terapia $terapia)
    {
        $validated = $request->validate([
            'nome' => 'required|unique:App\Models\Terapia,nome|max:255'
        ]);
        
        $terapia->nome = $validated['nome'];

        $terapia->save();
        return $terapia;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Terapia $terapia)
    {
        $terapia->delete();
        return '{}';
    }
}
