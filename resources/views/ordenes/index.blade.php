@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="text-2xl font-bold text-gray-800 text-center mb-5">Mis Órdenes</h1>

        <div class="card shadow-lg mt-6 rounded-lg">
            <div class="card-header bg-indigo-800 text-white p-4 rounded-t-lg">
                <h2 class="font-semibold text-lg">Órdenes Registradas</h2>
            </div>
            <div class="card-body bg-white p-6">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-sm text-gray-600 text-center">ID</th>
                                <th class="px-4 py-2 text-sm text-gray-600 text-center">Fecha</th>
                                <th class="px-4 py-2 text-sm text-gray-600 text-center">Total</th>
                                <th class="px-4 py-2 text-sm text-gray-600 text-center">Estado</th>
                                <th class="px-4 py-2 text-sm text-gray-600 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ordenes as $orden)
                                <tr class="hover:bg-gray-50 text-center">
                                    <td class="p-3">{{ $orden->id }}</td>
                                    <td class="p-3">{{ $orden->created_at->format('d/m/Y') }}</td>
                                    <td class="p-3">${{ number_format($orden->monto_total, 2) }}</td>
                                    <td class="p-3">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $orden->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $orden->estado === 'pendiente' ? 'Pendiente' : 'Enviado' }}
                                        </span>
                                    </td>
                                    <td class="p-3">
                                        <a href="{{ route('ordenes.mostrar', $orden->id) }}" class="btn btn-info btn-sm rounded-lg shadow-md text-white bg-indigo-800 hover:bg-indigo-900 transition duration-200 px-4 py-2">
                                            Ver detalles
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection