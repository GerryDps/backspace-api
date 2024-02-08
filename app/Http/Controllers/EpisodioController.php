<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

enum Intensita: int {
    case alta = 1;
    case media = 2;
    case bassa = 3;
}

class EpisodioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $episodio = Episodio::all();
        return $episodio;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $episodio = new Episodio;

        $validated = $request->validate([
            'timestamp' => 'required|date',
            'intensita' => ['required',Rule::enum(Intensita::class)],
            'descrizione' => 'string|nullable|max:255',
            'paziente_id' => 'required|integer|exists:App\Models\Paziente,id',
        ]);
 
        $episodio->fill($validated);
 
        $episodio->save();
        return $episodio;
    }

    /**
     * Display the specified resource.
     */
    public function show(Episodio $episodio)
    {
        //
        return $episodio;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Episodio $episodio)
    {
        $episodio = new Episodio;

        $validated = $request->validate([
            'timestamp' => 'required|date',
            'intensita' => ['required',Rule::enum(Intensita::class)],
            'descrizione' => 'string|nullable|max:255',
        ]);
 
        $episodio->timestamp = $validated['timestamp'];
        $episodio->intensita = $validated['intensita'];
        $episodio->descrizione = $validated['descrizione'];
 
        $episodio->save();
        return $episodio;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episodio $episodio)
    {
        $episodio->delete();
        return '{}';
    }
}
