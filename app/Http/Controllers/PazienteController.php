<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePazienteRequest;
use App\Http\Requests\UpdatePazienteRequest;
use Illuminate\Http\Request;
use App\Models\Paziente;

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
        $paziente->type = $validated['type'];
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
        $paziente->type = $validated['type'];
        if(isset($validated['doctor_id']))$paziente->doctor_id = $validated['doctor_id'];
        
        $paziente->save();
        return $paziente;
    }

    /**
     * Assegna un medico al paziente
     * Come update è solo semplificata
     * richiede solo medico_id
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
