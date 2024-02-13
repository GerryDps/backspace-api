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
            'name'=> 'required|unique:App\Models\Esercizio,name|max:255',
            'description'=> 'required|max:255',
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
    public function show(Esercizio $exercise)
    {
        //
        return $exercise;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Esercizio $exercise)
    {
        $validated = $request->validate([
            'name'=> 'required|unique:App\Models\Esercizio,name|max:255',
            'description'=> 'required|max:255',
            'video'=> 'required|max:255',
        ]);
        $exercise = new Esercizio;
        
        $exercise->fill($validated);
 
        $exercise->save();
        return $exercise;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Esercizio $exercise)
    {
        $exercise->delete();
        return '{}';
    }
}
