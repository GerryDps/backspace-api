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
        $esercizio = new Esercizio;
        return $esercizio->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $esercizio = new Esercizio;
        
        $esercizio->nome = $request->nome;
        $esercizio->descrizione = $request->descrizione;
        $esercizio->video = $request->video;
 
        $esercizio->save();
        return $this->show($esercizio);
    }

    /**
     * Display the specified resource.
     */
    public function show(Esercizio $esercizio)
    {
        //
        return ''.$esercizio;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Esercizio $esercizio)
    {
        if(isset($request->nome)){
            $esercizio->nome = $request->nome;
        }
        if(isset($request->descrizione)){
            $esercizio->descrizione = $request->descrizione;
        }
        if(isset($request->video)){
            $esercizio->video = $request->video;
        }
        
        $esercizio->save();
        return $this->show($esercizio);
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
