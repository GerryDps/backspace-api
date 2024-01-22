<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medico = new Medico;
        return $medico->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $medico = new Medico;
 
        $medico->email = $request->email;
        $medico->nome = $request->nome;
        $medico->cognome = $request->cognome;
        $medico->datadinascita = $request->datadinascita;
        $medico->password = password_hash($request->password,PASSWORD_DEFAULT);
 
        $medico->save();
        return $this->show($medico);
    }

    /**
     * Display the specified resource.
     */
    public function show(Medico $medico)
    {
        //
        return ''.$medico;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medico $medico)
    {
        if(isset($request->email)){
            $medico->email = $request->email;
        }
        if(isset($request->nome)){
            $medico->nome = $request->nome;
        }
        if(isset($request->cognome)){
            $medico->cognome = $request->cognome;
        }
        if(isset($request->datadinascita)){
            $medico->datadinascita = $request->datadinascita;
        }
        $medico->save();
        return $this->show($medico);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $medico)
    {
        $medico->delete();
        return '{}';
    }
}
