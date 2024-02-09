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
        $therapy = Terapia::all();
        return $therapy;
    }

    /**
     * Store a new terapy without medico_id only for internal use
     */
    protected function storeTerapia(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|unique:App\Models\Terapia,name|max:255',
        ]);
        $therapy = new Terapia;

        $therapy->name = $validated['name'];
 
        $therapy->save();

        return $therapy;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:App\Models\Terapia,name|max:255',
            'doctor_id' => 'required|exists:App\Models\Medico,id|integer',
        ]);
        $therapy = new Terapia;

        $therapy->name = $validated['name'];
 
        $therapy->save();
        /**
         * Creazione della relazione usando la table MedicoTerapia
         */
        $relazione = new MedicoTerapia;
        $relazione->doctor_id = $validated['doctor_id'];
        $relazione->therapy_id = $therapy->id;
        $relazione->save();

        return [$therapy,$relazione];
    }

    /**
     * Display the specified resource.
     */
    public function show(Terapia $therapy)
    {
        //
        return $therapy;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Terapia $therapy)
    {
        $validated = $request->validate([
            'name' => 'required|unique:App\Models\Terapia,name|max:255'
        ]);
        
        $therapy->name = $validated['name'];

        $therapy->save();
        return $therapy;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Terapia $therapy)
    {
        $therapy->delete();
        return '{}';
    }
}
