<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarritoItem;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function index()
    {
        $itemsCarrito = CarritoItem::where('usuario_id', Auth::id())
            ->with('producto')
            ->get();
            
        $total = $itemsCarrito->sum(function($item) {
            return $item->cantidad * $item->producto->precio;
        });
        
        return view('carrito.index', compact('itemsCarrito', 'total'));
    }
    
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
        ]);
        
        $itemExistente = CarritoItem::where('usuario_id', Auth::id())
            ->where('producto_id', $request->producto_id)
            ->first();
            
        if ($itemExistente) {
            $itemExistente->cantidad += $request->cantidad;
            $itemExistente->save();
        } else {
            CarritoItem::create([
                'usuario_id' => Auth::id(),
                'producto_id' => $request->producto_id,
                'cantidad' => $request->cantidad,
            ]);
        }
        
        return redirect()->back()->with('exito', 'Producto agregado al carrito.');
    }
    
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);
        
        $itemCarrito = CarritoItem::where('id', $id)
            ->where('usuario_id', Auth::id())
            ->firstOrFail();
            
        $itemCarrito->cantidad = $request->cantidad;
        $itemCarrito->save();
        
        return redirect()->route('carrito.index')->with('exito', 'Carrito actualizado.');
    }
    
    public function eliminar($id)
    {
        $itemCarrito = CarritoItem::where('id', $id)
            ->where('usuario_id', Auth::id())
            ->firstOrFail();
            
        $itemCarrito->delete();
        
        return redirect()->route('carrito.index')->with('exito', 'Producto eliminado del carrito.');
    }
    
    public function vaciar()
    {
        CarritoItem::where('usuario_id', Auth::id())->delete();
        
        return redirect()->route('carrito.index')->with('exito', 'Carrito vaciado.');
    }
}
