@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold text-center mb-6">Iniciar Sesión</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Correo Electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-medium mb-2">Contraseña</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror">
                
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-gray-600">Recordarme</label>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Iniciar Sesión
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <p class="text-gray-600">
                ¿No tienes una cuenta?
                <a href="{{ route('registro') }}" class="text-blue-500 hover:underline">Regístrate</a>
            </p>
        </div>
    </div>
</div>
@endsection