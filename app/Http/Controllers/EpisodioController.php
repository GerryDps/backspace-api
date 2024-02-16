<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EpisodioController extends Controller
{
    /**
     * Get one Episode by start-end 
     */
    private function _get(int $patient_id, string $start, string $end)
    {
        $start = strtotime($start);
        $end = strtotime($end);
        return Episodio::where('patient_id',$patient_id)->where('start',$start)->where('end',$end)->first();
    }

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
            'start' => 'required|date',
            'end' => 'required|date',
            'intensity' => 'required|integer|max:3',
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
     * Display the resource using patient_id, date.
     */
    public function getByDay(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'patient_id' => 'required|integer|exists:App\Models\Paziente,id',
        ]);
        $patient_id = $validated['patient_id'];
        $date = $validated['date'];
        $date = strtotime($date);

        return Episodio::where('patient_id',$patient_id)->whereBetween('timestamp',[$date,$date+86399])->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Episodio $episode)
    {

        $validated = $request->validate([
            'start' => 'required|date',
            'end' => 'required|date',
            'intensity' => 'required|integer|max:3',
            'description' => 'string|nullable|max:255',
        ]);
 
        $episode->start = $validated['start'];
        $episode->end = $validated['end'];
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
