@extends('layouts.app')

@section('content')
<div>
    <!-- Banner con imagen -->
    <div class="gradient-bg rounded-2xl p-8 mb-8 text-white relative overflow-hidden">
        <div class="absolute right-0 top-0 opacity-10">
            <i class="fas fa-boxes text-9xl mt-4 mr-4"></i>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <i class="fas fa-store text-3xl"></i>
                <h1 class="text-3xl font-bold">Panel de Control</h1>
            </div>
            <p class="text-lg opacity-90">Bienvenido al sistema de gestión de cajas y batches</p>
            <div class="mt-4 flex gap-2">
                <span class="bg-white/20 px-3 py-1 rounded-full text-sm">Gestión de inventario</span>
                <span class="bg-white/20 px-3 py-1 rounded-full text-sm">Control de batches</span>
            </div>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="gradient-bg w-12 h-12 rounded-lg flex items-center justify-center">
                    <i class="fas fa-boxes text-white text-xl"></i>
                </div>
                <span class="text-3xl font-bold text-gray-800">{{ \App\Models\Caja::count() }}</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-700">Total de Cajas</h3>
            <p class="text-gray-500 text-sm mt-2">Cajas registradas en el sistema</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 card-hover">
            <div class="flex items-center justify-between mb-4">
                <div class="bg-green-500 w-12 h-12 rounded-lg flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
                <span class="text-3xl font-bold text-gray-800">{{ \App\Models\Batch::count() }}</span>
            </div>
            <h3 class="text-lg font-semibold text-gray-700">Total de Batches</h3>
            <p class="text-gray-500 text-sm mt-2">Batches almacenados</p>
        </div>
    </div>

    <!-- Acciones rápidas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-box text-blue-500 mr-2"></i>
                Gestión de Cajas
            </h3>
            <p class="text-gray-600 mb-4">Administra las cajas, crea nuevas o edita existentes.</p>
            <a href="{{ route('cajas.index') }}" class="inline-flex items-center gap-2 gradient-bg text-white px-6 py-2 rounded-lg hover:shadow-lg transition">
                <i class="fas fa-arrow-right"></i>
                Ir a Cajas
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fas fa-chart-line text-green-500 mr-2"></i>
                Resumen Rápido
            </h3>
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Última caja creada:</span>
                    <span class="font-semibold">
                        @php
                            $ultimaCaja = \App\Models\Caja::latest()->first();
                        @endphp
                        {{ $ultimaCaja ? $ultimaCaja->display_name : 'Ninguna' }}
                    </span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Último batch creado:</span>
                    <span class="font-semibold">
                        @php
                            $ultimoBatch = \App\Models\Batch::latest()->first();
                        @endphp
                        {{ $ultimoBatch ? $ultimoBatch->numero_batch : 'Ninguno' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection