<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string',
            'description' => 'string',
            'seller' => 'boolean'
        ]);

        try {
            // Inicia uma transação
            DB::beginTransaction();

            // Insere o novo usuário na tabela 'users'
            DB::table('users')->insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'description' => $request->description,
                'seller' => $request->seller,
                'created_at' => now(),
            ]);

            // Confirma a transação
            DB::commit();

            return response()->json(['message' => 'Usuário cadastrado com sucesso'], Response::HTTP_CREATED);
        } catch (\Exception $e) {                        
            return response()->json(['error' => $e->getMessage() ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, $id)
    {
        // Valida os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'seller' => 'boolean'
        ]);

        try {
            // Procura o usuário pelo ID
            $user = User::findOrFail($id);

            // Atualiza os dados do usuário
            $user->name = $request->name;
            $user->description = $request->description;
            $user->seller = $request->seller;  
            $user->save();

            return response()->json(['message' => 'Usuário atualizado com sucesso'], Response::HTTP_OK);
        } catch (\Exception $e) {            
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            $cookie = cookie('cookie_token', $token, 60 * 24);
            return response(["token"=>$token], Response::HTTP_OK)->withoutCookie($cookie);
        } else {
            return response(["message"=> "Credenciais inválidas"],Response::HTTP_UNAUTHORIZED);
        }        
    }

    public function userProfile(Request $request) {
        return response()->json([
            "message" => "userProfile OK",
            "userData" => auth()->user()
        ], Response::HTTP_OK);
    }
    
    public function logout() {
        $cookie = Cookie::forget('cookie_token');
        return response(["message"=>"Cierre de sesión OK"], Response::HTTP_OK)->withCookie($cookie);
    }

    public function allUsers() {
       $users = User::all();
       return response()->json([
        "users" => $users
       ]);
    }
}
