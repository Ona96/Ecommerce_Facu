<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'E-Commerce') }}</title>
    
    <!-- Estilos -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('inicio') }}" class="text-xl font-bold text-blue-600">E-Commerce</a>
                
                <nav class="hidden md:flex space-x-6">
                    <a href="{{ route('inicio') }}" class="text-gray-600 hover:text-blue-600">Inicio</a>
                    <a href="{{ route('productos.index') }}" class="text-gray-600 hover:text-blue-600">Productos</a>
                    @auth
                        <a href="{{ route('carrito.index') }}" class="text-gray-600 hover:text-blue-600">Carrito</a>
                        <a href="{{ route('ordenes.index') }}" class="text-gray-600 hover:text-blue-600">Mis Pedidos</a>
                    @endauth
                </nav>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('carrito.index') }}" class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="absolute -top-2 -right-2 bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                0
                            </span>
                        </a>
                        
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center text-gray-600 focus:outline-none">
                                <span class="mr-2">{{ Auth::user()->nombre }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                                @if(Auth::user()->rol === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Panel de Admin</a>
                                @endif
                                <a href="{{ route('ordenes.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mis Pedidos</a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar Sesión</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Iniciar Sesión</a>
                        <a href="{{ route('registro') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Registrarse</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>
    
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
    
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">E-Commerce</h3>
                    <p class="text-gray-400">Tu tienda en línea de confianza para todos tus productos favoritos.</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('inicio') }}" class="text-gray-400 hover:text-white">Inicio</a></li>
                        <li><a href="{{ route('productos.index') }}" class="text-gray-400 hover:text-white">Productos</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contacto</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>Email: info@ecommerce.com</li>
                        <li>Teléfono: (123) 456-7890</li>
                        <li>Dirección: Calle Comercio 123, Ciudad</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} E-Commerce. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
</body>
</html>