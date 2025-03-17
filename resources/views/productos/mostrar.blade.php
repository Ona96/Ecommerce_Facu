@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="md:flex">
        <div class="md:w-1/2">
            <img src="data:image/jpeg;base64,{{ base64_encode($producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-auto">
        </div>
        
        <div class="p-6 md:w-1/2">
            <h1 class="text-2xl font-bold mb-2">{{ $producto->nombre }}</h1>
            <p class="text-gray-600 mb-4">{{ $producto->descripcion }}</p>
            
            <div class="text-2xl font-bold text-blue-600 mb-6">${{ number_format($producto->precio, 2) }}</div>
            
            @auth
                <form action="{{ route('carrito.agregar') }}" method="POST">
                    @csrf
                    <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                    
                    <div class="flex items-center mb-4">
                        <label for="cantidad" class="mr-4">Cantidad:</label>
                        <div class="flex items-center border rounded-md">
                            <button type="button" class="px-3 py-1 bg-gray-100" onclick="decrementarCantidad()">-</button>
                            <input type="number" name="cantidad" id="cantidad" value="1" min="1" class="w-16 text-center border-0 focus:ring-0">
                            <button type="button" class="px-3 py-1 bg-gray-100" onclick="incrementarCantidad()">+</button>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Agregar al Carrito
                    </button>
                </form>
            @else
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                    <p>Debes iniciar sesión para agregar productos al carrito.</p>
                </div>
                
                <a href="{{ route('login') }}" class="inline-block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg">
                    Iniciar Sesión
                </a>
            @endauth
            
            <div class="mt-6 border-t pt-6">
                <h3 class="font-semibold mb-2">Detalles del Producto:</h3>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>Envío gratis en pedidos superiores a $50000</li>
                    <li>Garantía de devolución de 30 días</li>
                    <li>Pago seguro</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    function decrementarCantidad() {
        const input = document.getElementById('cantidad');
        const valor = parseInt(input.value);
        if (valor > 1) {
            input.value = valor - 1;
        }
    }
    
    function incrementarCantidad() {
        const input = document.getElementById('cantidad');
        input.value = parseInt(input.value) + 1;
    }
</script>
@endsection