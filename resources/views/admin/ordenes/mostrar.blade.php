@extends('layouts.app')

@section('title', 'Detalle de Orden')

@section('content_header')
    <h1 class="text-2xl font-bold text-gray-800">Detalle de Orden</h1>
@stop

@section('content')
    @if (session('exito'))
        <div class="alert alert-success bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('exito') }}
        </div>
    @endif

    <div class="card shadow-lg mt-4 rounded-lg">
        <div class="card-body bg-white p-6">
            <h2 class="text-xl font-semibold mb-6 text-gray-700">Información de la Orden</h2>

            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th class="bg-gray-100 p-3 text-gray-600">ID</th>
                        <td class="p-3 text-gray-800">{{ $orden->id }}</td>
                    </tr>
                    <tr>
                        <th class="bg-gray-100 p-3 text-gray-600">Usuario</th>
                        <td class="p-3 text-gray-800">{{ $orden->usuario->nombre }}</td>
                    </tr>
                    <tr>
                        <th class="bg-gray-100 p-3 text-gray-600">Fecha de Creación</th>
                        <td class="p-3 text-gray-800">{{ $orden->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th class="bg-gray-100 p-3 text-gray-600">Estado</th>
                        <td class="p-3">
                            <span class="px-4 py-2 inline-flex text-sm font-semibold rounded-full 
                            {{ $orden->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                {{ $orden->estado === 'pendiente' ? 'Pendiente' : 'Enviado' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-gray-100 p-3 text-gray-600">Dirección de Envío</th>
                        <td class="p-3 text-gray-800">{{ $orden->direccion_envio ?? 'No especificada' }}</td>
                    </tr>
                    <tr>
                        <th class="bg-gray-100 p-3 text-gray-600">Total</th>
                        <td class="p-3 text-gray-800">${{ number_format($orden->monto_total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
            
            <h3 class="text-lg font-semibold mt-6 mb-4 text-gray-700">Productos</h3>
            <table class="table table-bordered table-striped">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm text-gray-600">Producto</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-600">Cantidad</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-600">Precio Unitario</th>
                        <th class="px-4 py-2 text-left text-sm text-gray-600">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orden->items as $item)
                        <tr>
                            <td class="p-3">{{ $item->producto->nombre }}</td>
                            <td class="p-3">{{ $item->cantidad }}</td>
                            <td class="p-3">${{ number_format($item->precio, 2) }}</td>
                            <td class="p-3">${{ number_format($item->precio * $item->cantidad, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.ordenes.index') }}" class="btn btn-primary px-6 py-3 rounded-lg shadow-md text-white bg-blue-500 hover:bg-blue-600 transition duration-200">
            Volver a la lista de Ordenes
        </a>
    </div>
@stop