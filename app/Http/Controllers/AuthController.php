<?php

//metodo de autenticacion, para la api.

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    private function jwt(User $user)
    {
        $payload = [
            "iss" => "api-lumen",
            "sub" => $user->id,
            "iat" => time(),
            "exp" => time() + (60 * 60) // 1 hora de expiración
        ];
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    public function authenticate()
    {
        $this->validate($this->request, [
            'email' => 'required|email',
            'pass' => 'required'
        ]);

        $user = User::where('email', $this->request->input('email'))->first();

        if (!$user) {
            return response()->json(['error' => 'No existe el correo.'], 400);
        }

        // Verificar la contraseña hasheada
        if (Hash::check($this->request->input('pass'), $user->pass)) {
            return response()->json(['token' => $this->jwt($user)], 200);
        }

        return response()->json(['error' => 'Usuario o contraseña incorrecto.'], 400);
    }
}