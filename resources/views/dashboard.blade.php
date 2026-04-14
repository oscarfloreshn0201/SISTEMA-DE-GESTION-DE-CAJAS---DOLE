@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Banner -->
    <div class="bg-blanco rounded-2xl p-8 relative overflow-hidden shadow-sm">
        <div class="absolute right-0 top-0 opacity-5">
            <i class="fas fa-boxes text-9xl mt-4 mr-4"></i>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <div class="bg-negro p-3 rounded-xl">
                    <i class="fas fa-store text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-negro">Panel de Control</h1>
                    <p class="text-gris mt-1">Bienvenido, {{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjetas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $totalCajas = \App\Models\Caja::count();
            $totalBatches = \App\Models\Batch::count();
            $cajasEsteAnio = \App\Models\Caja::where('año', date('Y'))->count();
            $promedio = $totalCajas > 0 ? round($totalBatches / $totalCajas, 1) : 0;
        @endphp

        <div class="bg-blanco rounded-2xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gris text-sm mb-1">Total Cajas</p>
                    <p class="text-3xl font-bold text-negro">{{ $totalCajas }}</p>
                </div>
                <div class="bg-negro w-12 h-12 rounded-xl flex items-center justify-center">
                    <i class="fas fa-boxes text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-blanco rounded-2xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gris text-sm mb-1">Total Batches</p>
                    <p class="text-3xl font-bold text-negro">{{ $totalBatches }}</p>
                </div>
                <div class="bg-negro w-12 h-12 rounded-xl flex items-center justify-center">
                    <i class="fas fa-tags text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-blanco rounded-2xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gris text-sm mb-1">Cajas {{ date('Y') }}</p>
                    <p class="text-3xl font-bold text-negro">{{ $cajasEsteAnio }}</p>
                </div>
                <div class="bg-negro w-12 h-12 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-white text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-blanco rounded-2xl shadow-sm p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gris text-sm mb-1">Promedio x Caja</p>
                    <p class="text-3xl font-bold text-negro">{{ $promedio }}</p>
                </div>
                <div class="bg-negro w-12 h-12 rounded-xl flex items-center justify-center">
                    <i class="fas fa-chart-pie text-white text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Búsqueda -->
    <div class="bg-blanco rounded-2xl shadow-sm p-6">
        <h3 class="text-lg font-bold text-negro mb-4">
            <i class="fas fa-search mr-2 text-gris"></i> Búsqueda Rápida
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <input type="text" id="searchCaja" placeholder="Buscar caja..." 
                       class="w-full px-4 py-2 border border-gris rounded-lg focus:outline-none focus:border-negro bg-blanco">
            </div>
            <div>
                <input type="text" id="searchBatch" placeholder="Buscar batch..." 
                       class="w-full px-4 py-2 border border-gris rounded-lg focus:outline-none focus:border-negro bg-blanco">
            </div>
        </div>
    </div>

    <!-- Acciones -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blanco rounded-2xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-negro mb-3">
                <i class="fas fa-box mr-2 text-gris"></i> Gestión de Cajas
            </h3>
            <a href="{{ route('cajas.index') }}" class="btn-primary inline-block px-4 py-2 rounded-lg">
                Ir a Cajas
            </a>
        </div>

        <div class="bg-negro rounded-2xl shadow-sm p-6">
            <h3 class="text-lg font-bold text-white mb-3">
                <i class="fas fa-bolt mr-2"></i> Acciones Rápidas
            </h3>
            <div class="flex gap-3">
                <a href="{{ route('cajas.create') }}" class="bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition">
                    Nueva Caja
                </a>
                <a href="{{ route('cajas.index') }}" class="bg-white/20 text-white px-4 py-2 rounded-lg hover:bg-white/30 transition">
                    Ver Cajas
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('searchCaja')?.addEventListener('keypress', function(e) {
    if(e.key === 'Enter' && this.value.trim()) {
        window.location.href = '/cajas?numero_caja=' + encodeURIComponent(this.value);
    }
});

document.getElementById('searchBatch')?.addEventListener('keypress', function(e) {
    if(e.key === 'Enter' && this.value.trim()) {
        window.location.href = '/batches/search?numero_batch=' + encodeURIComponent(this.value);
    }
});
</script>
@endsection