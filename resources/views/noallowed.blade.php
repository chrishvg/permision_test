<x-app-layout>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white shadow-md rounded-lg p-8 max-w-md text-center">
            <h1 class="text-2xl font-bold text-red-600 mb-4">Acceso Denegado</h1>
            <p class="text-gray-700 mb-6">Este usuario no tiene permisos para acceder a esta página.</p>
            <a href="{{ url('/') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Regresar a la Página Principal
            </a>
        </div>
    </div>
</x-app-layout>
