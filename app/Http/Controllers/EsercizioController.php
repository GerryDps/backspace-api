<?php

namespace App\Http\Controllers;

use App\Models\Esercizio;
use Illuminate\Http\Request;

class EsercizioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $esercizio = Esercizio::all();
        return $esercizio;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome'=> 'required|unique:App\Models\Esercizio,nome|max:255',
            'descrizione'=> 'required|max:255',
            'video'=> 'required|max:255',
        ]);
        $esercizio = new Esercizio;
        
        $esercizio->fill($validated);
 
        $esercizio->save();
        return $esercizio;
    }

    /**
     * Display the specified resource.
     */
    public function show(Esercizio $esercizio)
    {
        //
        return $esercizio;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Esercizio $esercizio)
    {
        $validated = $request->validate([
            'nome'=> 'required|unique:App\Models\Esercizio,nome|max:255',
            'descrizione'=> 'required|max:255',
            'video'=> 'required|max:255',
        ]);
        $esercizio = new Esercizio;
        
        $esercizio->fill($validated);
 
        $esercizio->save();
        return $esercizio;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Esercizio $esercizio)
    {
        $esercizio->delete();
        return '{}';
    }
}
