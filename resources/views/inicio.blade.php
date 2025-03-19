@extends('layouts.app')

@section('content')


<div class="bg-indigo-50 text-gray-800 py-8 px-4">
    <div class="container mx-auto text-center">
        <h1 class="text-3xl md:text-5xl font-bold mb-4 text-indigo-900">Bienvenido Venecia Modas</h1>
        <p class="text-lg mb-8 text-gray-600">Explora nuestra colección de selectos vestidos</p>
    </div>
</div>

<div class="mb-12">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Productos Destacados</h2>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($productosDestacados as $producto)
            <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-200">
                <div class="h-48 overflow-hidden">
                    <img src="data:image/jpeg;base64,{{ base64_encode($producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover">
                </div>
                
                <div class="p-4">
                    <h3 class="font-semibold text-lg mb-2 text-gray-800">{{ $producto->nombre }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $producto->descripcion }}</p>
                    
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-indigo-800">${{ number_format($producto->precio, 2) }}</span>
                        
                        <a href="{{ route('productos.mostrar', $producto->id) }}" class="text-indigo-800 hover:text-indigo-600">
                            Ver Detalles
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="mt-8 text-center">
        <a href="{{ route('productos.index') }}" class="inline-block bg-indigo-800 hover:bg-indigo-900 text-white font-medium px-6 py-3 rounded-lg transition duration-200">
            Ver Todos los Productos
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
        </svg>
        <h3 class="text-lg font-semibold mb-2 text-gray-800">Envío Gratis</h3>
        <p class="text-gray-600">En pedidos superiores a $50000</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
        </svg>
        <h3 class="text-lg font-semibold mb-2 text-gray-800">Pago Seguro</h3>
        <p class="text-gray-600">Transacciones 100% seguras</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
        </svg>
        <h3 class="text-lg font-semibold mb-2 text-gray-800">Garantía de Devolución</h3>
        <p class="text-gray-600">30 días de garantía</p>
    </div>
</div>

@endsection
