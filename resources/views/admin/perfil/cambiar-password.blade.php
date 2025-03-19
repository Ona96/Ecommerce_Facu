@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Cambiar Contraseña</h1>

@if (session('exito'))
    <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
        {{ session('exito') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
    <div class="p-6 border-b">
        <h2 class="text-lg font-semibold">Actualizar Contraseña</h2>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.perfil.actualizar-password') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="current_password" class="block text-sm font-medium text-gray-500 mb-2">Contraseña Actual</label>
                <input type="password" name="current_password" id="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                @error('current_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-500 mb-2">Nueva Contraseña</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-500 mb-2">Confirmar Nueva Contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="flex items-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md transition duration-200">
                    Actualizar Contraseña
                </button>
                <a href="{{ route('admin.dashboard') }}" class="ml-4 text-gray-500 hover:text-gray-700">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection