@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-5">Detalles de la Orden</h1>

        @if (session('exito'))
            <div class="alert alert-success bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('exito') }}
            </div>
        @endif

        <div class="card shadow-lg mt-4 rounded-lg">
            <div class="card-header bg-indigo-800 text-white p-4 rounded-t-lg">
                <h2 class="font-semibold text-lg">Orden #{{ $orden->id }}</h2>
            </div>
            <div class="card-body bg-white p-6">
                <h2 class="text-xl font-semibold mb-6 text-gray-700">Información de la Orden</h2>

                <table class="table table-bordered table-striped w-full mb-6">
                    <tbody>
                        <tr>
                            <th class="bg-gray-100 p-3 text-gray-600">Cliente</th>
                            <td class="p-3 text-gray-800">{{ $orden->usuario->nombre }}</td>
                        </tr>
                        <tr>
                            <th class="bg-gray-100 p-3 text-gray-600">Fecha</th>
                            <td class="p-3 text-gray-800">{{ $orden->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-gray-100 p-3 text-gray-600">Estado</th>
                            <td class="p-3">
                                <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full {{ $orden->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $orden->estado === 'pendiente' ? 'Pendiente' : 'Enviado' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-gray-100 p-3 text-gray-600">Total</th>
                            <td class="p-3 text-gray-800">${{ number_format($orden->monto_total, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Sección destacada para la dirección de envío -->
                <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-semibold mb-2 text-indigo-800">Dirección de Envío</h3>
                    <p class="text-gray-800 whitespace-pre-line">{{ $orden->direccion_envio ?? 'No especificada' }}</p>
                </div>
                
                <h3 class="text-lg font-semibold mt-6 mb-4 text-gray-700">Productos</h3>
                <table class="table table-bordered table-striped w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm text-gray-600">Producto</th>
                            <th class="px-4 py-2 text-left text-sm text-gray-600">Cantidad</th>
                            <th class="px-4 py-2 text-left text-sm text-gray-600">Precio Unitario</th>
                            <th class="px-4 py-2 text-left text-sm text-gray-600">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orden->items as $item)
                            <tr>
                                <td class="p-3">{{ $item->producto->nombre }}</td>
                                <td class="p-3">{{ $item->cantidad }}</td>
                                <td class="p-3">${{ number_format($item->precio, 2) }}</td>
                                <td class="p-3">${{ number_format($item->precio * $item->cantidad, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-6">
                    <a href="{{ route('ordenes.index') }}" class="btn btn-primary px-6 py-3 rounded-lg shadow-md text-white bg-indigo-800 hover:bg-indigo-900 transition duration-200">
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection