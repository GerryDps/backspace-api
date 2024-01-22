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
        $questionario = new Questionario;
        return $questionario->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $questionario = new Questionario;
 
        $questionario->paziente_id = $request->paziente_id;
 
        $questionario->save();
        return $this->show($questionario);
    }

    /**
     * Display the specified resource.
     */
    public function show(Questionario $questionario)
    {
        //
        return ''.$questionario;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Questionario $questionario)
    {
        return '{}';
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Questionario $questionario)
    {
        $questionario->delete();
        return '{}';
    }
}
