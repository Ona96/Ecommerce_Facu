<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\OrdenItem;
use App\Models\CarritoItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdenController extends Controller
{
    public function index()
    {
        $ordenes = Orden::where('usuario_id', Auth::id())
            ->with('items.producto')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('ordenes.index', compact('ordenes'));
    }
    
    public function mostrar($id)
    {
        $orden = Orden::where('id', $id)
            ->where('usuario_id', Auth::id())
            ->with('items.producto')
            ->firstOrFail();
            
        return view('ordenes.mostrar', compact('orden'));
    }
    
    public function checkout()
    {
        $itemsCarrito = CarritoItem::where('usuario_id', Auth::id())
            ->with('producto')
            ->get();
            
        if ($itemsCarrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }
        
        $total = $itemsCarrito->sum(function($item) {
            return $item->cantidad * $item->producto->precio;
        });
        
        return view('ordenes.checkout', compact('itemsCarrito', 'total'));
    }
    
    public function guardar(Request $request)
    {
        $request->validate([
            'direccion_envio' => 'required|string',
        ]);
        
        $itemsCarrito = CarritoItem::where('usuario_id', Auth::id())
            ->with('producto')
            ->get();
            
        if ($itemsCarrito->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }
        
        $total = $itemsCarrito->sum(function($item) {
            return $item->cantidad * $item->producto->precio;
        });
        
        DB::beginTransaction();
        
        try {
            // Crear orden
            $orden = Orden::create([
                'usuario_id' => Auth::id(),
                'monto_total' => $total,
                'estado' => 'pendiente',
            ]);
            
            // Crear items de la orden
            foreach ($itemsCarrito as $item) {
                OrdenItem::create([
                    'orden_id' => $orden->id,
                    'producto_id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                    'precio' => $item->producto->precio,
                ]);
            }
            
            // Vaciar carrito
            CarritoItem::where('usuario_id', Auth::id())->delete();
            
            DB::commit();
            
            return redirect()->route('ordenes.mostrar', $orden->id)
                ->with('exito', 'Orden creada exitosamente.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()->with('error', 'Ocurrió un error al procesar tu orden.');
        }
    }
}
