@extends('layouts.app')

@section('title', 'Editar Orden')

@section('content_header')
    <h1 class="text-2xl font-bold text-gray-800">Editar Orden #{{ $orden->id }}</h1>
@stop

@section('content')
    @if (session('exito'))
        <div class="alert alert-success bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('exito') }}
        </div>
    @endif

    <div class="card shadow-lg mt-4 rounded-lg">
        <div class="card-header bg-blue-600 text-white p-4 rounded-t-lg">
            <h2 class="font-semibold text-lg">Modificar Orden</h2>
        </div>
        <div class="card-body bg-white p-6">
            <form action="{{ route('admin.ordenes.actualizar', $orden->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label for="usuario" class="block text-sm font-medium text-gray-700 mb-2">Usuario</label>
                        <input type="text" class="form-control bg-gray-100 p-2 w-full rounded-md" value="{{ $orden->usuario->nombre }}" disabled>
                    </div>
                    
                    <div class="mb-4">
                        <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Creación</label>
                        <input type="text" class="form-control bg-gray-100 p-2 w-full rounded-md" value="{{ $orden->created_at->format('d/m/Y H:i') }}" disabled>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="mb-4">
                        <label for="estado" class="block text-sm font-medium text-gray-700 mb-2">Estado</label>
                        <select name="estado" id="estado" class="form-control p-2 w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                            <option value="pendiente" {{ $orden->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="enviado" {{ $orden->estado === 'enviado' ? 'selected' : '' }}>Enviado</option>
                        </select>
                        @error('estado')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="total" class="block text-sm font-medium text-gray-700 mb-2">Total</label>
                        <input type="text" class="form-control bg-gray-100 p-2 w-full rounded-md" value="${{ number_format($orden->monto_total, 2) }}" disabled>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="direccion_envio" class="block text-sm font-medium text-gray-700 mb-2">Dirección de Envío</label>
                    <textarea name="direccion_envio" id="direccion_envio" rows="3" class="form-control p-2 w-full rounded-md border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">{{ $orden->direccion_envio ?? '' }}</textarea>
                    @error('direccion_envio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="mt-6 flex gap-4">
                    <button type="submit" class="btn btn-success px-6 py-3 rounded-lg shadow-md text-white bg-green-500 hover:bg-green-600 transition duration-200">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('admin.ordenes.mostrar', $orden->id) }}" class="btn btn-secondary px-6 py-3 rounded-lg shadow-md text-white bg-gray-500 hover:bg-gray-600 transition duration-200">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop