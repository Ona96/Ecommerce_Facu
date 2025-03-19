@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-2xl font-bold text-gray-800 text-center mb-5">Carrito de Compras</h1>

    @if(session('exito'))
        <div class="alert alert-success bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('exito') }}
        </div>
    @endif

    @if(count($itemsCarrito) > 0)
        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-indigo-800 text-white p-4 rounded-t-lg">
                <h2 class="font-semibold text-lg">Productos en tu Carrito</h2>
            </div>
            <div class="card-body bg-white p-6">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-sm text-gray-600">Producto</th>
                                <th class="px-4 py-2 text-sm text-gray-600 text-center">Precio</th>
                                <th class="px-4 py-2 text-sm text-gray-600 text-center">Cantidad</th>
                                <th class="px-4 py-2 text-sm text-gray-600 text-center">Subtotal</th>
                                <th class="px-4 py-2 text-sm text-gray-600 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($itemsCarrito as $item)
                                <tr class="hover:bg-gray-50 border-b">
                                    <td class="p-3">{{ $item->producto->nombre }}</td>
                                    <td class="p-3 text-center">${{ number_format($item->producto->precio, 2) }}</td>
                                    <td class="p-3 text-center">{{ $item->cantidad }}</td>
                                    <td class="p-3 text-center">${{ number_format($item->producto->precio * $item->cantidad, 2) }}</td>
                                    <td class="p-3 text-center">
                                        <form action="{{ route('carrito.eliminar', $item->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm transition duration-200">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                    <table class="table table-bordered table-striped w-full mb-0">
                        <tbody>
                            <tr>
                                <th class="bg-gray-100 p-3 text-gray-600">Total</th>
                                <td class="p-3 text-gray-800 font-semibold text-lg">${{ number_format($total, 2) }}</td>
                            </tr>
                            <tr>
                                <th class="bg-gray-100 p-3 text-gray-600">Envío</th>
                                <td class="p-3">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $total >= 50000 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $total >= 50000 ? 'Gratis' : '$5000.00' }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-gray-100 p-3 text-gray-600">Total a pagar</th>
                                <td class="p-3 text-gray-800 font-bold text-xl">${{ number_format($total >= 50000 ? $total : $total + 5000, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col sm:flex-row justify-between items-center mt-6 gap-4">
                    <div>
                        <form action="{{ route('carrito.vaciar') }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow-md transition duration-200">
                                Vaciar Carrito
                            </button>
                        </form>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-primary px-6 py-3 rounded-lg shadow-md text-indigo-800 border border-indigo-800 hover:bg-indigo-800 hover:text-white transition duration-200 text-center">
                            Continuar Comprando
                        </a>
                        <a href="{{ route('checkout') }}" class="btn btn-success px-6 py-3 rounded-lg shadow-md text-white bg-indigo-800 hover:bg-indigo-900 transition duration-200 text-center">
                            Finalizar Compra
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-indigo-800 text-white p-4 rounded-t-lg">
                <h2 class="font-semibold text-lg">Carrito Vacío</h2>
            </div>
            <div class="card-body bg-white p-6 text-center">
                <div class="py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-indigo-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h4 class="mb-3 text-xl font-semibold text-gray-800">Tu carrito está vacío</h4>
                    <p class="text-gray-600 mb-6">¡No te preocupes! Agrega productos a tu carrito y continúa con tu compra.</p>
                    <a href="{{ route('productos.index') }}" class="btn btn-primary px-6 py-3 rounded-lg shadow-md text-white bg-indigo-800 hover:bg-indigo-900 transition duration-200 inline-block">
                        Ir a la tienda
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection