<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BienvenidaMail;

class RegisterController extends Controller
{
    public function mostrarFormularioRegistro()
    {
        return view('auth.registro');
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'client', // El rol predeterminado es cliente para evitar problemas de inicio de sesion
        ]);

        // Verificar que el usuario se haya creado correctamente antes de enviar el correo
        if ($usuario && $usuario->email) {
            try {
                Mail::to($usuario->email)->send(new BienvenidaMail($usuario));
            } catch (\Exception $e) {
                // Registrar el error pero continuar con el proceso
                \Log::error('Error al enviar correo de bienvenida: ' . $e->getMessage());
            }
        }

        // Autenticar al usuario si se creó correctamente
        if ($usuario) {
            Auth::login($usuario);
        }

        return redirect('/');
    }
}
