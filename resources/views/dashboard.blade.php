<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Panel de Administración') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md mb-6">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300">
                        Bienvenido al Panel de Administración
                    </h3>
                    <div class="flex items-center space-x-4">
                        <!-- Perfil y Logout -->
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="text-gray-600 dark:text-gray-200 focus:outline-none">
                                    {{ Auth::user()->name }}
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link href="{{ route('profile.edit') }}">
                                    {{ __('Perfil') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Opción Clientes -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Clientes</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Gestiona todos los clientes de la plataforma.</p>
                    <a href="{{ route('clientes.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                        Ver Clientes
                    </a>
                </div>

                <!-- Opción Productos -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Productos</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Administra los productos disponibles para la venta.</p>
                    <a href="{{ route('productos.index') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                        Ver Productos
                        <a href="{{ route('estadisticas.index') }}">Estadísticas</a>

                    </a>
                </div>

                <!-- Opción Ventas -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md hover:bg-blue-50 dark:hover:bg-gray-700">
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Ventas</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Revisa las ventas realizadas y genera facturas.</p>
                    <a href="{{ route('ventas.index') }}" class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg">
                        Ver Ventas
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
