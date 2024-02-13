<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

enum Intensity: int {
    case high = 1;
    case medium = 2;
    case low = 3;
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
            'intensity' => ['required',Rule::enum(Intensity::class)],
            'description' => 'string|nullable|max:255',
            'patient_id' => 'required|integer|exists:App\Models\Paziente,id',
        ]);
 
        $episodio->fill($validated);
 
        $episodio->save();
        return $episodio;
    }

    /**
     * Display the specified resource.
     */
    public function show(Episodio $episode)
    {
        //
        return $episode;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Episodio $episode)
    {

        $validated = $request->validate([
            'timestamp' => 'required|date',
            'intensity' => ['required',Rule::enum(Intensity::class)],
            'description' => 'string|nullable|max:255',
        ]);
 
        $episode->timestamp = $validated['timestamp'];
        $episode->intensity = $validated['intensity'];
        $episode->description = $validated['description'];
 
        $episode->save();
        return $episode;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episodio $episode)
    {
        $episode->delete();
        return '{}';
    }
}
