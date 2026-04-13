@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-azul-marino">
                <i class="fas fa-user-edit mr-2"></i>Editar Usuario
            </h2>
            <p class="text-gray-600 mt-1">Modifique los datos del usuario</p>
        </div>
        <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-gray-700">
            ← Volver al Listado
        </a>
    </div>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-user mr-2 text-azul-principal"></i>Nombre de Usuario
            </label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal focus:ring-2 focus:ring-azul-celeste"
                   required>
            @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-id-card mr-2 text-azul-principal"></i>Nombre Completo
            </label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal focus:ring-2 focus:ring-azul-celeste"
                   required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-key mr-2 text-azul-principal"></i>Nueva Contraseña (opcional)
            </label>
            <input type="password" name="password" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal focus:ring-2 focus:ring-azul-celeste"
                   placeholder="Dejar en blanco para mantener la actual">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-2">
                <i class="fas fa-check-circle mr-2 text-azul-principal"></i>Confirmar Contraseña
            </label>
            <input type="password" name="password_confirmation" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal focus:ring-2 focus:ring-azul-celeste"
                   placeholder="Repite la nueva contraseña">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg hover:shadow-lg transition">
                <i class="fas fa-save mr-2"></i> Actualizar Usuario
            </button>
            <a href="{{ route('users.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancelar
            </a>
        </div>
    </form>
</div>

<style>
.btn-primary {
    background-color: #4A90E2;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #357ABD;
    transform: translateY(-2px);
}
</style>
@endsection