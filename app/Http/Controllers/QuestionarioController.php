<?php

namespace App\Http\Controllers;

use App\Models\Questionario;
use Illuminate\Http\Request;

class QuestionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionario = Questionario::all();
        return $questionario;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $questionario = new Questionario;
        $validated = $request->validate([
            'patient_id' => 'required|integer|exists:App\Models\Paziente,id',
        ]);
 
        $questionario->patient_id = $validated['patient_id'];
 
        $questionario->save();
        return $questionario;
    }

    /**
     * Display the specified resource.
     */
    public function show(Questionario $questionary)
    {
        //
        return $questionary;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Questionario $questionary)
    {
        return $questionary;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Questionario $questionary)
    {
        $questionary->delete();
        return '{}';
    }
}
