<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Http\Requests\StoreMedicoRequest;
use App\Http\Requests\UpdateMedicoRequest;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medico = Medico::all();
        return $medico;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicoRequest $request)
    {
        $validated = $request->validated();
        $medico = new Medico;
 
        $medico->email = $validated['email'];
        $medico->name = $validated['name'];
        $medico->surname = $validated['surname'];
        $medico->birthday = $validated['birthday'];
        $medico->password = password_hash($validated['password'],PASSWORD_DEFAULT);
 
        $medico->save();
        $medico->refresh();
        return $medico;
    }

    /**
     * Display the specified resource.
     */
    public function show(Medico $doctor)
    {
        //
        return $doctor;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicoRequest $request, Medico $doctor)
    {
        $validated = $request->validated();

        $doctor->email = $validated['email'];
        $doctor->name = $validated['name'];
        $doctor->surname = $validated['surname'];
        $doctor->birthday = $validated['birthday'];
        
        $doctor->save();
        $doctor->refresh();
        return $doctor;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $doctor)
    {
        $doctor->delete();
        return '{}';
    }
}
