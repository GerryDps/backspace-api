<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\PazienteController;
use App\Http\Requests\StorePazienteRequest;

class UtenteController extends Controller
{
    /**
    * login.
    */
    public function login(Request $request, Response $response, PazienteController $pazienteController)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        $paziente = $pazienteController->findByEmail($request->email);
     
        if (! $paziente || ! password_verify($request->password, $paziente->password)) {
            return $response->setStatusCode(401)->setContent('Invalid username or password');
        }

        $token = $paziente->createToken('paziente_token');
        return $response->setStatusCode(200)->setContent(['token' => $token->plainTextToken ]);
    }

    /**
    * register.
    */
    public function register(StorePazienteRequest $request, Response $response, PazienteController $pazienteController)
    {
        $paziente = $pazienteController->store($request);
        if($paziente){
            $token = $paziente->createToken('paziente_token');
            return $response->setStatusCode(200)->setContent(['token' => $token->plainTextToken,'paziente' => $paziente]);
        }else{
            return $response->setStatusCode(400);
        }
    }
}