@extends('layouts.app')

@section('content')
<div class="mb-8">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg shadow-lg p-8 text-white">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Bienvenido a nuestra tienda en línea</h1>
            <p class="text-lg mb-6">Descubre nuestra selección de productos de alta calidad a precios increíbles.</p>
            <a href="{{ route('productos.index') }}" class="inline-block bg-white text-blue-600 font-medium px-6 py-3 rounded-lg hover:bg-gray-100 transition duration-200">
                Ver Productos
            </a>
        </div>
    </div>
</div>

<div class="mb-12">
    <h2 class="text-2xl font-bold mb-6">Productos Destacados</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($productosDestacados as $producto)
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
    
    <div class="mt-8 text-center">
        <a href="{{ route('productos.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-3 rounded-lg transition duration-200">
            Ver Todos los Productos
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
        </svg>
        <h3 class="text-lg font-semibold mb-2">Envío Gratis</h3>
        <p class="text-gray-600">En pedidos superiores a $50000</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
        </svg>
        <h3 class="text-lg font-semibold mb-2">Pago Seguro</h3>
        <p class="text-gray-600">Transacciones 100% seguras</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
        </svg>
        <h3 class="text-lg font-semibold mb-2">Garantía de Devolución</h3>
        <p class="text-gray-600">30 días de garantía</p>
    </div>
</div>
@endsection