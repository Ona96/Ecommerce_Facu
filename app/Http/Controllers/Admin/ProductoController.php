<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.productos.index', compact('productos'));
    }
    
    public function crear()
    {
        return view('admin.productos.crear');
    }
    
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'required|image|max:2048',
            'destacado' => 'boolean',
        ]);
        
        $imagenData = file_get_contents($request->file('imagen')->path());
        
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $imagenData,
            'destacado' => $request->destacado ?? false,
        ]);
        
        return redirect()->route('admin.productos.index')
            ->with('exito', 'Producto creado exitosamente.');
    }
    
    public function editar($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.productos.editar', compact('producto'));
    }
    
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|max:2048',
            'destacado' => 'boolean',
        ]);
        
        $producto = Producto::findOrFail($id);
        
        $datos = [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'destacado' => $request->destacado ?? false,
        ];
        
        if ($request->hasFile('imagen')) {
            $imagenData = file_get_contents($request->file('imagen')->path());
            $datos['imagen'] = $imagenData;
        }
        
        $producto->update($datos);
        
        return redirect()->route('admin.productos.index')
            ->with('exito', 'Producto actualizado exitosamente.');
    }
    
    public function eliminar($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        
        return redirect()->route('admin.productos.index')
            ->with('exito', 'Producto eliminado exitosamente.');
    }
}
