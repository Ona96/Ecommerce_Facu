<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function editarPassword()
    {
        return view('admin.perfil.cambiar-password');
    }
    
    public function actualizarPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = Auth::user();
        
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }
        
        $user->password = Hash::make($request->password);
        $user->save();
        
        return redirect()->route('admin.perfil.password')
            ->with('exito', 'Contraseña actualizada exitosamente.');
    }
}