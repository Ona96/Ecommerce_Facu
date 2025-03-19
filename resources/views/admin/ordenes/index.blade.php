@extends('layouts.app')

@section('title', 'Ordenes')

@section('content_header')
    <h1 class="text-2xl font-bold text-gray-800 text-center">Lista de Ordenes</h1>
@stop

@section('content')
    @if (session('exito'))
        <div class="alert alert-success bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('exito') }}
        </div>
    @endif
    <div class="card shadow-lg mt-6 rounded-lg">
        <div class="card-header bg-blue-600 text-white p-4 rounded-t-lg">
            <h2 class="font-semibold text-lg">Ordenes Registradas</h2>
        </div>
        <div class="card-body bg-white p-6">
            <div class="overflow-x-auto">
                <table class="table table-striped table-hover w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-sm text-gray-600 text-center">ID</th>
                            <th class="px-4 py-2 text-sm text-gray-600 text-center">Usuario</th>
                            <th class="px-4 py-2 text-sm text-gray-600 text-center">Total</th>
                            <th class="px-4 py-2 text-sm text-gray-600 text-center">Estado</th>
                            <th class="px-4 py-2 text-sm text-gray-600 text-center" colspan="3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordenes as $orden)
                            <tr class="hover:bg-gray-50 text-center">
                                <td class="p-3">{{ $orden->id }}</td>
                                <td class="p-3">{{ $orden->usuario->nombre }}</td>
                                <td class="p-3">${{ number_format($orden->monto_total, 2) }}</td>
                                <td class="p-3">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $orden->estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                        {{ $orden->estado === 'pendiente' ? 'Pendiente' : 'Enviado' }}
                                    </span>
                                </td>
                                <td class="p-3">
                                    <a class="btn btn-info btn-sm rounded-lg shadow-md text-white bg-blue-500 hover:bg-blue-600 transition duration-200 px-4 py-2" href="{{ route('admin.ordenes.mostrar', $orden->id) }}">
                                        Ver Orden
                                    </a>
                                </td>
                                <td class="p-3">
                                    <a href="{{ route('admin.ordenes.editar', $orden->id) }}" class="btn btn-primary btn-sm rounded-lg shadow-md text-white bg-blue-500 hover:bg-blue-600 transition duration-200 px-4 py-2">
                                        Editar
                                    </a>
                                </td>
                                <td class="p-3">
                                    <form action="{{ route('admin.ordenes.eliminar', $orden->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-lg shadow-md text-white bg-red-500 hover:bg-red-600 transition duration-200 px-4 py-2">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop