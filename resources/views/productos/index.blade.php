@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Todos los Productos</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($productos as $producto)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="h-48 overflow-hidden">
                <img src="data:image/jpeg;base64,{{ base64_encode($producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
            </div>
            
            <div class="p-4">
                <h3 class="font-semibold text-lg mb-2">{{ $producto->nombre }}</h3>
                <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $producto->descripcion }}</p>
                
                <div class="flex items-center justify-between">
                    <span class="text-lg font-bold">${{ number_format($producto->precio, 2) }}</span>
                    
                    <a href="{{ route('productos.mostrar', $producto->id) }}" class="text-blue-500 hover:text-blue-600">
                        Ver Detalles
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-8">
    {{ $productos->links() }}
</div>
@endsection