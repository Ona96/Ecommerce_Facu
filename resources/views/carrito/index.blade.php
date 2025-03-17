@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Carrito de Compras</h1>

@if($itemsCarrito->isEmpty())
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <h2 class="text-lg font-semibold mb-2">Tu carrito está vacío</h2>
        <p class="text-gray-600 mb-6">Parece que aún no has agregado ningún producto a tu carrito.</p>
        <a href="{{ route('productos.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-3 rounded-lg transition duration-200">
            Continuar Comprando
        </a>
    </div>
@else
    <div class="flex flex-col md:flex-row gap-6">
        <div class="md:w-2/3">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($itemsCarrito as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md">
                                            <img src="data:image/jpeg;base64,{{ base64_encode($item->producto->imagen) }}" alt="{{ $item->producto->nombre }}" class="h-full w-full object-cover">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $item->producto->nombre }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <form action="{{ route('carrito.actualizar', $item->id) }}" method="POST" class="flex items-center justify-center">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex items-center border rounded-md">
                                            <button type="button" class="px-3 py-1 bg-gray-100" onclick="decrementarCantidad('cantidad-{{ $item->id }}', this.form)">-</button>
                                            <input type="number" name="cantidad" id="cantidad-{{ $item->id }}" value="{{ $item->cantidad }}" min="1" class="w-12 text-center border-0 focus:ring-0">
                                            <button type="button" class="px-3 py-1 bg-gray-100" onclick="incrementarCantidad('cantidad-{{ $item->id }}', this.form)">+</button>
                                        </div>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                    ${{ number_format($item->producto->precio, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    ${{ number_format($item->producto->precio * $item->cantidad, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4 flex justify-between">
                <a href="{{ route('productos.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Continuar Comprando
                </a>
                
                <form action="{{ route('carrito.vaciar') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-600">
                        Vaciar Carrito
                    </button>
                </form>
            </div>
        </div>
        
        <div class="md:w-1/3">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Resumen del Pedido</h2>
                
                <div class="border-t border-b py-4 mb-4">
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600">Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Envío</span>
                        <span>{{ $total >= 50000 ? 'Gratis' : '$50000.00' }}</span>
                    </div>
                </div>
                
                <div class="flex justify-between font-semibold text-lg mb-6">
                    <span>Total</span>
                    <span>${{ number_format($total >= 50000 ? $total : $total + 5, 2) }}</span>
                </div>
                
                <a href="{{ route('checkout') }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg text-center focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Proceder al Pago
                </a>
            </div>
        </div>
    </div>
@endif

<script>
    function decrementarCantidad(inputId, form) {
        const input = document.getElementById(inputId);
        const valor = parseInt(input.value);
        if (valor > 1) {
            input.value = valor - 1;
            form.submit();
        }
    }
    
    function incrementarCantidad(inputId, form) {
        const input = document.getElementById(inputId);
        input.value = parseInt(input.value) + 1;
        form.submit();
    }
</script>
@endsection