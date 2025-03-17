@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.productos.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Volver a Productos
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="p-6 border-b">
        <h1 class="text-2xl font-bold">Editar Producto</h1>
    </div>
    
    <form action="{{ route('admin.productos.actualizar', $producto->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nombre" class="block text-gray-700 font-medium mb-2">Nombre del Producto</label>
                <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $producto->nombre) }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nombre') border-red-500 @enderror" required>
                
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="precio" class="block text-gray-700 font-medium mb-2">Precio</label>
                <input type="number" name="precio" id="precio" value="{{ old('precio', $producto->precio) }}" step="0.01" min="0" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('precio') border-red-500 @enderror" required>
                
                @error('precio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mt-6">
            <label for="descripcion" class="block text-gray-700 font-medium mb-2">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('descripcion') border-red-500 @enderror" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
            
            @error('descripcion')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mt-6">
            <label for="imagen" class="block text-gray-700 font-medium mb-2">Imagen del Producto</label>
            
            @if(isset($producto->imagen))
                <div class="mb-2">
                    <p class="text-sm text-gray-600 mb-2">Imagen actual:</p>
                    <img src="data:image/jpeg;base64,{{ base64_encode($producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-32 w-auto object-cover rounded-md">
                </div>
            @endif
            
            <input type="file" name="imagen" id="imagen" accept="image/*" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('imagen') border-red-500 @enderror">
            <p class="text-sm text-gray-500 mt-1">Deja este campo vacío si no deseas cambiar la imagen.</p>
            
            @error('imagen')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mt-6">
            <div class="flex items-center">
                <input type="checkbox" name="destacado" id="destacado" value="1" {{ old('destacado', $producto->destacado) ? 'checked' : '' }} class="mr-2">
                <label for="destacado" class="text-gray-700">Destacar en la página de inicio</label>
            </div>
        </div>
        
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Actualizar Producto
            </button>
        </div>
    </form>
</div>
@endsection