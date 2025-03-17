@extends('layouts.app')

@section('content')
<div class="mb-6">
    <a href="{{ route('ordenes.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Volver a Mis Pedidos
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
    <div class="p-6 border-b">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Pedido #{{ $orden->id }}</h1>
            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $orden->status === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                {{ $orden->estado === 'pendiente' ? 'Pendiente' : 'Enviado' }}
            </span>
        </div>
        <p class="text-gray-600 mt-2">Realizado el {{ $orden->created_at->format('d/m/Y H:i') }}</p>
    </div>
    
    <div class="p-6 border-b">
        <h2 class="text-lg font-semibold mb-4">Productos</h2>
        
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orden->items as $item)
                        <tr>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0 overflow-hidden rounded-md">
                                        @if(isset($item->producto->imagen))
                                            <img src="data:image/jpeg;base64,{{ base64_encode($item->producto->imagen) }}" alt="{{ $item->producto->nombre }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                <span class="text-gray-500 text-xs">Sin imagen</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->producto->nombre }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                {{ $item->cantidad }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                ${{ number_format($item->precio, 2) }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium">
                                ${{ number_format($item->precio * $item->cantidad, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="p-6">
        <div class="flex justify-end">
            <div class="w-full md:w-1/3">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Subtotal</span>
                    <span>${{ number_format($orden->monto_total, 2) }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Envío</span>
                    <span>{{ $orden->monto_total >= 50 ? 'Gratis' : '$5.00' }}</span>
                </div>
                <div class="border-t pt-2 mt-2">
                    <div class="flex justify-between font-semibold">
                        <span>Total</span>
                        <span>${{ number_format($orden->monto_total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection