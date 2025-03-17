<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function destacados()
    {
        $productosDestacados = Producto::where('destacado', 1)
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();
        
        return view('inicio', compact('productosDestacados'));
    }
    
    public function index()
    {
        $productos = Producto::orderBy('created_at', 'desc')->paginate(12);
        
        return view('productos.index', compact('productos'));
    }
    
    public function mostrar($id)
    {
        $producto = Producto::findOrFail($id);
        
        return view('productos.mostrar', compact('producto'));
    }
}
