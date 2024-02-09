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
        return $medico;
    }

    /**
     * Display the specified resource.
     */
    public function show(Medico $medico)
    {
        //
        return $medico;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicoRequest $request, Medico $medico)
    {
        $validated = $request->validated();

        $medico->email = $validated['email'];
        $medico->name = $validated['name'];
        $medico->surname = $validated['surname'];
        $medico->birthday = $validated['birthday'];
        
        $medico->save();
        return $medico;
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
