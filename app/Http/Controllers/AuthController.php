<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Validator;

class AuthController extends Controller
{
  /**
     * Registro de usuario
     */
    public function signUp(Request $request)
    {

        $validation_rules = [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string'
        ];

        $validator = Validator::make($request->all(), $validation_rules);

        if ($validator->fails()) {

            return response()->json(['status' => false , 'message' => 'Validacion Incorrecta' ,'errors' => $validator->errors()], 201);

        } else {

            $uuid  = Str::uuid();

            User::create([
               'name' => $request->name,
               'email' => $request->email,
               'password' => bcrypt($request->password),
               'uuid' => $uuid
           ]);

           $user = User::where('uuid',$uuid)->first();

           $user->assignRole('client');

           $tokenResult = $user->createToken('Personal Access Token');

           $token = $tokenResult->token;
           $token->expires_at = Carbon::now()->addWeeks(2);
           $token->save();

           return response()->json([
               'access_token' => $tokenResult->accessToken,
               'token_type' => 'Bearer',
               'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
               'message' => 'Usuario Creado Correctamente.',
               'status' => true
           ]);

        }

    }

    /**
     * Inicio de sesión y creación de token
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString(),
            'message' => 'Usuario Autenticado',
               'status' => true
        ]);
    }

    /**
     * Cierre de sesión (anular el token)
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Login Correcto'
        ]);
    }

    /**
     * Obtener el objeto User como json
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
