<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orden;
use App\Models\Producto;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function index()
{
    $totalOrdenes = Orden::count();
    $totalProductos = Producto::count();
    $totalUsuarios = Usuario::where('rol', 'client')->count();
    
    $ordenesRecientes = Orden::with('usuario')
        ->whereHas('usuario') // Solo los forros con cuenta aparecen
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    return view('admin.dashboard', compact(
        'totalOrdenes', 
        'totalProductos', 
        'totalUsuarios', 
        'ordenesRecientes'
    ));
}
}