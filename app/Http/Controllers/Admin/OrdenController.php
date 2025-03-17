<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orden;

class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::with('usuario')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.ordenes.index', compact('ordenes'));
    }
    
    public function mostrar($id)
    {
        $orden = Orden::with(['usuario', 'items.producto'])
            ->findOrFail($id);
            
        return view('admin.ordenes.mostrar', compact('orden'));
    }
    
    public function actualizarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,enviado',
        ]);
        
        $orden = Orden::findOrFail($id);
        $orden->status = $request->status;
        $orden->save();
        
        return redirect()->route('admin.ordenes.mostrar', $id)
            ->with('exito', 'Estado de la orden actualizado.');
    }
}
