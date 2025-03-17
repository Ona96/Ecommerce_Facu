@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Finalizar Compra</h1>

<div class="flex flex-col md:flex-row gap-6">
    <div class="md:w-2/3">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Información de Envío</h2>
            
            <form action="{{ route('ordenes.guardar') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="direccion_envio" class="block text-gray-700 font-medium mb-2">Dirección de Envío</label>
                    <textarea name="direccion_envio" id="direccion_envio" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('direccion_envio') border-red-500 @enderror" required>{{ old('direccion_envio') }}</textarea>
                    
                    @error('direccion_envio')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="border-t pt-6 mt-6">
                    <h2 class="text-lg font-semibold mb-4">Método de Pago</h2>
                    
                    <div class="mb-4">
                        <div class="flex items-center mb-2">
                            <input type="radio" name="metodo_pago" id="tarjeta" value="tarjeta" class="mr-2" checked>
                            <label for="tarjeta">Tarjeta de Crédito/Débito</label>
                        </div>
                        
                        <div class="flex items-center">
                            <input type="radio" name="metodo_pago" id="efectivo" value="efectivo" class="mr-2">
                            <label for="efectivo">Pago contra entrega</label>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Confirmar Pedido
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <div class="md:w-1/3">
        <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
            <h2 class="text-lg font-semibold mb-4">Resumen del Pedido</h2>
            
            <div class="mb-4">
                <div class="max-h-60 overflow-y-auto">
                    @foreach($itemsCarrito as $item)
                        <div class="flex items-center py-2 border-b">
                            <div class="h-12 w-12 flex-shrink-0 overflow-hidden rounded-md">
                                @if(isset($item->producto->imagen))
                                    <img src="data:image/jpeg;base64,{{ base64_encode($item->producto->imagen) }}" alt="{{ $item->producto->nombre }}" class="h-full w-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-gray-500 text-xs">Sin imagen</span>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 flex-1">
                                <div class="text-sm font-medium text-gray-900">{{ $item->producto->nombre }}</div>
                                <div class="text-sm text-gray-500">{{ $item->cantidad }} x ${{ number_format($item->producto->precio, 2) }}</div>
                            </div>
                            <div class="text-sm font-medium text-gray-900">${{ number_format($item->producto->precio * $item->cantidad, 2) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            
            <div class="border-t border-b py-4 mb-4">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Envío</span>
                    <span>{{ $total >= 50 ? 'Gratis' : '$5.00' }}</span>
                </div>
            </div>
            
            <div class="flex justify-between font-semibold text-lg">
                <span>Total</span>
                <span>${{ number_format($total >= 50 ? $total : $total + 5, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection