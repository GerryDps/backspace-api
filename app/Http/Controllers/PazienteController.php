<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePazienteRequest;
use App\Http\Requests\UpdatePazienteRequest;
use App\Models\Paziente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PazienteController extends Controller
{
    /**
     * Get paziente by email
     */
    public static function findByEmail(String $email)
    {
        $paziente = Paziente::where('email', $email)->first();
        return $paziente;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paziente = new Paziente;
        return $paziente->get();
    }

    /**
     * Store a newly created resource in storage.
     * Requests/StorePazienteRequest fa la validazione
     */
    public function store(StorePazienteRequest $request)
    {
        $validated = $request->validated();

        $paziente = new Paziente;
 
        $paziente->email = $validated['email'];
        $paziente->nome = $validated['nome'];
        $paziente->cognome = $validated['cognome'];
        $paziente->datadinascita = $validated['datadinascita'];
        $paziente->tipo = $validated['tipo'];
        $paziente->password = password_hash($validated['password'],PASSWORD_DEFAULT);
 
        $paziente->save();
        return $paziente;
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
     * Requests/UpdatePazienteRequest fa la validazione
     */
    public function update(UpdatePazienteRequest $request, Paziente $paziente)
    {
        $validated = $request->validated();

        $paziente->email = $validated['email'];
        $paziente->nome = $validated['nome'];
        $paziente->cognome = $validated['cognome'];
        $paziente->datadinascita = $validated['datadinascita'];
        $paziente->tipo = $validated['tipo'];
        $paziente->medico_id = $validated['medico_id'];

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
