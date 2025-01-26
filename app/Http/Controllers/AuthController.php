<?php

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

    /**
     * Registrar un nuevo usuario.
     */
    public function register(Request $request)
    {
        // Valida los campos
        // Nota: Lumen usa "validar" con $this->validate, si está habilitado.
        // Ajusta las reglas según tu preferencia.
        $this->validate($this->request, [
            'nombre' => 'required|string',
            'email'  => 'required|email|unique:users,email',
            'pass'   => 'required|min:4',
            'telefono' => 'required|max:10'
        ]);

        // Obtener los datos del Request
        $nombre   = $this->request->input('nombre');
        $email    = $this->request->input('email');
        $pass     = $this->request->input('pass');
        $telefono = $this->request->input('telefono');

        // Crear el usuario
        // IMPORTANTE: hashear la contraseña
        $user = new User;
        $user->nombre   = $nombre;
        $user->email    = $email;
        $user->pass  = Hash::make($request->input('pass'));
        //$user->pass     = Hash::make($pass);
        $user->telefono = $telefono;
        $user->status   = true; // o 1, si tu columna es bool
        $user->save();

        // Si quieres devolver un token inmediatamente:
        $token = $this->jwt($user);

        return response()->json([
            'success' => true,
            'user'    => $user,
            'token'   => $token
        ], 201);
    }

    /**
     * Iniciar sesión (generar token si pass coincide).
     */
    public function authenticate()
    {
        $this->validate($this->request, [
            'email' => 'required|email',
            'pass'  => 'required'
        ]);       

        $user = User::where('email', $this->request->input('email'))->first();

        if (!$user) {
            return response()->json(['error' => 'No existe el correo.'], 400);
        }

        // Verificar la contraseña hasheada
        if (Hash::check($this->request->input('pass'), $user->pass)) {
            return response()->json([
                'success' => true,
                'token'   => $this->jwt($user),
                'user'    => $user
            ], 200);
        }

        return response()->json(['error' => 'Usuario o contraseña incorrecto.'], 400);
    }
}
