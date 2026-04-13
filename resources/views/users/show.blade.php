@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6 max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-azul-marino">
            <i class="fas fa-user-circle mr-2"></i>Detalle del Usuario
        </h2>
        <a href="{{ route('users.index') }}" class="text-gray-500 hover:text-gray-700">
            ← Volver al Listado
        </a>
    </div>

    <div class="space-y-4">
        <div class="flex items-center justify-center mb-6">
            <div class="gradient-azul w-24 h-24 rounded-full flex items-center justify-center">
                <i class="fas fa-user text-white text-4xl"></i>
            </div>
        </div>

        <div class="border-b pb-3">
            <p class="text-sm text-gray-500">ID</p>
            <p class="text-lg font-semibold text-azul-marino">{{ $user->id }}</p>
        </div>

        <div class="border-b pb-3">
            <p class="text-sm text-gray-500">Nombre de Usuario</p>
            <p class="text-lg font-semibold text-azul-marino">{{ $user->username }}</p>
        </div>

        <div class="border-b pb-3">
            <p class="text-sm text-gray-500">Nombre Completo</p>
            <p class="text-lg font-semibold text-azul-marino">{{ $user->name }}</p>
        </div>

        <div class="border-b pb-3">
            <p class="text-sm text-gray-500">Fecha de Registro</p>
            <p class="text-lg font-semibold text-azul-marino">{{ $user->created_at->format('d/m/Y H:i:s') }}</p>
        </div>

        <div class="pt-4">
            <p class="text-sm text-gray-500">Última Actualización</p>
            <p class="text-lg font-semibold text-azul-marino">{{ $user->updated_at->format('d/m/Y H:i:s') }}</p>
        </div>
    </div>

    <div class="flex gap-3 mt-6 pt-4 border-t">
        <a href="{{ route('users.edit', $user) }}" class="btn-primary text-white px-6 py-2 rounded-lg">
            <i class="fas fa-edit mr-2"></i> Editar Usuario
        </a>
        <a href="{{ route('users.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg">
            Volver
        </a>
    </div>
</div>

<style>
.gradient-azul {
    background: linear-gradient(135deg, #87CEEB 0%, #4A90E2 100%);
}

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