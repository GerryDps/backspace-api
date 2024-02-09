<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePazienteRequest;
use App\Http\Requests\UpdatePazienteRequest;
use Illuminate\Http\Request;
use App\Models\Paziente;

class PazienteController extends Controller
{
    /**
     * Get patient by email
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
        $paziente = Paziente::all();
        return $paziente;
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
        $paziente->name = $validated['name'];
        $paziente->surname = $validated['surname'];
        $paziente->birthday = $validated['birthday'];
        if(isset($validated['hasDoctor']))$paziente->hasDoctor = $validated['hasDoctor'];
        if(isset($validated['hasQuestionary']))$paziente->hasQuestionary = $validated['hasQuestionary'];
        if(isset($validated['type']))$paziente->type = $validated['type'];
        $paziente->password = password_hash($validated['password'],PASSWORD_DEFAULT);

        $paziente->save();
        $paziente->refresh();
        unset($paziente['type']);
        return $paziente;
    }

    /**
     * Display the specified resource.
     */
    public function show(Paziente $paziente)
    {
        //
        return $paziente;
    }

    /**
     * Update the specified resource in storage.
     * Requests/UpdatePazienteRequest fa la validazione
     */
    public function update(UpdatePazienteRequest $request, Paziente $paziente)
    {
        $validated = $request->validated();

        $paziente->email = $validated['email'];
        $paziente->name = $validated['name'];
        $paziente->surname = $validated['surname'];
        $paziente->birthday = $validated['birthday'];
        if(isset($validated['hasDoctor']))$paziente->hasDoctor = $validated['hasDoctor'];
        if(isset($validated['hasQuestionary']))$paziente->hasQuestionary = $validated['hasQuestionary'];
        if(isset($validated['type']))$paziente->type = $validated['type'];
        if(isset($validated['doctor_id']))$paziente->doctor_id = $validated['doctor_id'];
        
        $paziente->save();
        $paziente->refresh();
        unset($paziente['type']);
        return $paziente;
    }

    /**
     * Update the specified resource in storage.
     * Update only the doctor_id of a patient
     */
    public function updateMedico(Request $request, Paziente $paziente)
    {
        $validated = $request->validate([
            'doctor_id'=> 'required|integer|exists:App\Models\Medico,id',
        ]);

        $paziente->doctor_id = $validated['doctor_id'];
        
        $paziente->save();
        return $paziente;
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
