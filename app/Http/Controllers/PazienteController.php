<?php

namespace App\Http\Controllers;

use App\Models\Paziente;
use Illuminate\Http\Request;

class PazienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return '{}';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $paziente = new Paziente;
 
        $paziente->email = $request->email;
        $paziente->nome = $request->nome;
        $paziente->cognome = $request->cognome;
        $paziente->datadinascita = $request->datadinascita;
        $paziente->tipo = $request->tipo;
        $paziente->password = password_hash($request->password,PASSWORD_DEFAULT);
 
        $paziente->save();
        return $this->show($paziente);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paziente $paziente)
    {
        //
        return ''.$paziente;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paziente $paziente)
    {
        if(isset($request->email)){
            $paziente->email = $request->email;
        }
        if(isset($request->nome)){
            $paziente->nome = $request->nome;
        }
        if(isset($request->cognome)){
            $paziente->cognome = $request->cognome;
        }
        if(isset($request->datadinascita)){
            $paziente->datadinascita = $request->datadinascita;
        }
        if(isset($request->tipo)){
            $paziente->tipo = $request->tipo;
        }
        if(isset($request->medico_id)){
            $paziente->medico_id = $request->medico_id;
        }
        $paziente->save();
        return $this->show($paziente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paziente $paziente)
    {
        $paziente->delete();
        return '{}';
    }
}
