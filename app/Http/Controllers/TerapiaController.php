<?php

namespace App\Http\Controllers;

use App\Models\Terapia;
use Illuminate\Http\Request;

class TerapiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terapia = new Terapia;
        return $terapia->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $terapia = new Terapia;

        $terapia->nome = $request->nome;
 
        $terapia->save();
        return $this->show($terapia);
    }

    /**
     * Display the specified resource.
     */
    public function show(Terapia $terapia)
    {
        //
        return ''.$terapia;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Terapia $terapia)
    {
        if(isset($request->nome)){
            $terapia->nome = $request->nome;
        }

        $terapia->save();
        return $this->show($terapia);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Terapia $terapia)
    {
        $terapia->delete();
        return '{}';
    }
}
