<?php
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 02/06/15
 * Time: 20:36
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiController
{

    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->response->errorUnauthorized('Mauvais email / mot de passe');
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return $this->response->errorInternalError('Impossible de créer un token');
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function logout()
    {
var_dump("logout ok");
    }

} 