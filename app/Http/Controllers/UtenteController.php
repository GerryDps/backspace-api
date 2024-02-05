<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\PazienteController;
use App\Models\Paziente;
use App\Http\Requests\StorePazienteRequest;
use Illuminate\Support\Str;

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

        $token = $paziente->createToken($request->email); // "personal_access_tokens"."name" sarà l'email (table.name)
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

    /**
     * logout
     */
    public function logout(Request $request, Response $response, PazienteController $pazienteController){

    }

    /**
     * forgot password
     */
    public function forgotpassword(Request $request, Response $response, PazienteController $pazienteController){
        $request->validate(['email' => 'required|email']);

        $paziente = $pazienteController->findByEmail($request->email);
        $token = Password::createToken($paziente);
        
        //sostituire con l'invio del token via email
        return $response->setStatusCode(200)->setContent(['token'=> $token ]);


        /**
         * Questo dovrebbe trovare l'utente e generare un token per l'utente
         * inviare via email il token.
         */
        /* $status = Password::sendResetLink($request->only('email'));
        $request->validate(['email' => 'required|email']);
 
        $status = Password::sendResetLink(
        $request->only('email')
        );
 
        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]); */
    }

    /**
     * reset password
     */
    public function resetpassword(Request $request, Response $response, PazienteController $pazienteController){
        
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:255', // senza |confirmed 
        ]);
        
        $paziente = $pazienteController->findByEmail($request->email);
        $token = Password::tokenExists($paziente,$request->token);
        if($token){
            $paziente->password = password_hash($request->password,PASSWORD_DEFAULT);
            $paziente->save();
            Password::deleteToken($paziente);
            //$paziente->tokens()->delete(); // cancella tutti i token per l'accesso, (scollega tutti)
            return $response->setStatusCode(200)->setContent(['paziente'=> $paziente ]);
        }
        
     
        /**
         * Questo dovrebbe servire per resettare la password
         * cambiare config/auth.php da users a paziente (forse)
         * Il Password::reset() si occupa di tutto, update , deletetoken ecc
         */
        /* $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Paziente $user, string $password) {

                $user->forceFill(['password' => password_hash($password,PASSWORD_DEFAULT)])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]); */ 
    }
}