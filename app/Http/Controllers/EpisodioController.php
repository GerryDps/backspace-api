<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use Illuminate\Http\Request;

class EpisodioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $episodio = new Episodio;
        return $episodio->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $episodio = new Episodio;
 
        $episodio->timestamp = $request->timestamp;
        $episodio->intensita = $request->intensita;
        $episodio->descrizione = $request->descrizione;
 
        $episodio->save();
        return $this->show($episodio);
    }

    /**
     * Display the specified resource.
     */
    public function show(Episodio $episodio)
    {
        //
        return ''.$episodio;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Episodio $episodio)
    {
        if(isset($request->timestamp)){
            $episodio->timestamp = $request->timestamp;
        }
        if(isset($request->intensita)){
            $episodio->intensita = $request->intensita;
        }
        if(isset($request->descrizione)){
            $episodio->descrizione = $request->descrizione;
        }
        
        $episodio->save();
        return $this->show($episodio);
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
