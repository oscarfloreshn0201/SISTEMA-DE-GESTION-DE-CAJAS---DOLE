@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-azul-marino">
            <i class="fas fa-boxes mr-2"></i>Listado de Cajas
        </h2>
        <a href="{{ route('cajas.create') }}" class="btn-primary text-white px-4 py-2 rounded-lg">
            <i class="fas fa-plus mr-1"></i> Nueva Caja
        </a>
    </div>

    <!-- Panel de Filtros Avanzados -->
    <div class="bg-gradient-to-r from-azul-celeste to-white rounded-xl p-5 mb-6 shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-azul-marino">
                <i class="fas fa-filter mr-2"></i>Filtrar Cajas
            </h3>
            <button onclick="toggleFiltros()" class="text-azul-principal hover:text-azul-marino text-sm">
                <i class="fas fa-chevron-down" id="toggleIcon"></i> Ocultar filtros
            </button>
        </div>
        
        <div id="filtrosPanel">
            <form method="GET" action="{{ route('cajas.index') }}" id="filterForm">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-azul-marino mb-1">
                            <i class="fas fa-hashtag mr-1"></i>Número de Caja
                        </label>
                        <input type="text" name="numero_caja" value="{{ request('numero_caja') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal focus:ring-2 focus:ring-azul-celeste"
                               placeholder="Ej: 001, 002...">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-azul-marino mb-1">
                            <i class="fas fa-calendar mr-1"></i>Mes
                        </label>
                        <select name="mes" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal">
                            <option value="">Todos los meses</option>
                            <option value="1" {{ request('mes') == '1' ? 'selected' : '' }}>📅 Enero</option>
                            <option value="2" {{ request('mes') == '2' ? 'selected' : '' }}>📅 Febrero</option>
                            <option value="3" {{ request('mes') == '3' ? 'selected' : '' }}>📅 Marzo</option>
                            <option value="4" {{ request('mes') == '4' ? 'selected' : '' }}>📅 Abril</option>
                            <option value="5" {{ request('mes') == '5' ? 'selected' : '' }}>📅 Mayo</option>
                            <option value="6" {{ request('mes') == '6' ? 'selected' : '' }}>📅 Junio</option>
                            <option value="7" {{ request('mes') == '7' ? 'selected' : '' }}>📅 Julio</option>
                            <option value="8" {{ request('mes') == '8' ? 'selected' : '' }}>📅 Agosto</option>
                            <option value="9" {{ request('mes') == '9' ? 'selected' : '' }}>📅 Septiembre</option>
                            <option value="10" {{ request('mes') == '10' ? 'selected' : '' }}>📅 Octubre</option>
                            <option value="11" {{ request('mes') == '11' ? 'selected' : '' }}>📅 Noviembre</option>
                            <option value="12" {{ request('mes') == '12' ? 'selected' : '' }}>📅 Diciembre</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-azul-marino mb-1">
                            <i class="fas fa-calendar-year mr-1"></i>Año
                        </label>
                        <select name="año" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal">
                            <option value="">Todos los años</option>
                            @for($i = date('Y') + 1; $i >= date('Y') - 5; $i--)
                                <option value="{{ $i }}" {{ request('año') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-azul-marino mb-1">
                            <i class="fas fa-sort-amount-down mr-1"></i>Ordenar por
                        </label>
                        <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal">
                            <option value="created_at_desc" {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>📅 Más recientes</option>
                            <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>📅 Más antiguas</option>
                            <option value="numero_caja_asc" {{ request('sort') == 'numero_caja_asc' ? 'selected' : '' }}>🔢 Número (asc)</option>
                            <option value="numero_caja_desc" {{ request('sort') == 'numero_caja_desc' ? 'selected' : '' }}>🔢 Número (desc)</option>
                            <option value="mes_asc" {{ request('sort') == 'mes_asc' ? 'selected' : '' }}>📆 Mes (asc)</option>
                            <option value="mes_desc" {{ request('sort') == 'mes_desc' ? 'selected' : '' }}>📆 Mes (desc)</option>
                            <option value="batches_count" {{ request('sort') == 'batches_count' ? 'selected' : '' }}>📊 Más batches</option>
                        </select>
                    </div>
                </div>
                
                <!-- Filtro por rango de fechas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-azul-marino mb-1">
                            <i class="fas fa-calendar-alt mr-1"></i>Fecha desde
                        </label>
                        <input type="date" name="fecha_desde" value="{{ request('fecha_desde') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-azul-marino mb-1">
                            <i class="fas fa-calendar-alt mr-1"></i>Fecha hasta
                        </label>
                        <input type="date" name="fecha_hasta" value="{{ request('fecha_hasta') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal">
                    </div>
                </div>
                
                <!-- Botones de acción -->
                <div class="flex gap-3 mt-5">
                    <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg hover:shadow-lg transition">
                        <i class="fas fa-search mr-2"></i>Aplicar Filtros
                    </button>
                    <a href="{{ route('cajas.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                        <i class="fas fa-undo mr-2"></i>Limpiar Filtros
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Resultados y contador -->
    <div class="flex justify-between items-center mb-4">
        <p class="text-sm text-gray-600">
            <i class="fas fa-chart-line mr-1"></i>
            Mostrando <span class="font-semibold text-azul-marino">{{ $cajas->total() }}</span> cajas
        </p>
        <div class="flex gap-2">
            <button onclick="cambiarVista('grid')" class="text-gray-500 hover:text-azul-principal transition">
                <i class="fas fa-th-large text-lg"></i>
            </button>
            <button onclick="cambiarVista('list')" class="text-gray-500 hover:text-azul-principal transition">
                <i class="fas fa-list text-lg"></i>
            </button>
        </div>
    </div>

    @if($cajas->isEmpty())
        <div class="text-center py-12 bg-gray-50 rounded-lg">
            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No hay cajas registradas</p>
            <p class="text-gray-400 text-sm mt-2">Crea tu primera caja haciendo clic en "Nueva Caja"</p>
        </div>
    @else
        <!-- Vista Grid (por defecto) -->
        <div id="gridView" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($cajas as $caja)
            <div class="border rounded-lg p-4 hover:shadow-lg transition-all duration-300 card-hover bg-white">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <div class="gradient-azul w-10 h-10 rounded-lg flex items-center justify-center">
                                <i class="fas fa-box text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-azul-principal">
                                    Caja #{{ $caja->numero_caja }}
                                </h3>
                                <p class="text-sm text-gray-500">
                                    {{ $caja->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-2 space-y-1">
                            <p class="text-gray-700">
                                <i class="fas fa-calendar text-azul-principal mr-2 text-sm"></i>
                                {{ $caja->nombre_mes }} {{ $caja->año }}
                            </p>
                            @if($caja->descripcion)
                                <p class="text-gray-500 text-sm line-clamp-2">
                                    <i class="fas fa-align-left text-gray-400 mr-2 text-sm"></i>
                                    {{ Str::limit($caja->descripcion, 60) }}
                                </p>
                            @endif
                            <p class="text-sm text-gray-400 mt-2">
                                <i class="fas fa-tags mr-1"></i>
                                {{ $caja->batches->count() }} batches
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('cajas.show', $caja) }}" 
                           class="text-azul-principal hover:text-azul-marino transition"
                           title="Ver">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('cajas.edit', $caja) }}" 
                           class="text-yellow-500 hover:text-yellow-700 transition"
                           title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('cajas.destroy', $caja) }}" 
                              onsubmit="return confirm('¿Eliminar esta caja? Se eliminarán todos sus batches')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 transition" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Vista Lista (oculta por defecto) -->
        <div id="listView" class="hidden overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg">
                <thead>
                    <tr class="bg-amarillo-palido">
                        <th class="py-3 px-4 border text-left">ID</th>
                        <th class="py-3 px-4 border text-left">Número</th>
                        <th class="py-3 px-4 border text-left">Mes/Año</th>
                        <th class="py-3 px-4 border text-left">Descripción</th>
                        <th class="py-3 px-4 border text-left">Batches</th>
                        <th class="py-3 px-4 border text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cajas as $caja)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-2 px-4 border">{{ $caja->id }}</td>
                        <td class="py-2 px-4 border font-medium">{{ $caja->numero_caja }}</td>
                        <td class="py-2 px-4 border">{{ $caja->nombre_mes }} {{ $caja->año }}</td>
                        <td class="py-2 px-4 border">{{ Str::limit($caja->descripcion ?? '-', 40) }}</td>
                        <td class="py-2 px-4 border">
                            <span class="bg-azul-celeste text-azul-marino px-2 py-1 rounded-full text-xs">
                                {{ $caja->batches->count() }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border text-center">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('cajas.show', $caja) }}" class="text-azul-principal hover:text-azul-marino">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('cajas.edit', $caja) }}" class="text-yellow-500 hover:text-yellow-700">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('cajas.destroy', $caja) }}" 
                                      onsubmit="return confirm('¿Eliminar esta caja?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        <div class="mt-6">
            {{ $cajas->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<script>
// Toggle filtros
function toggleFiltros() {
    const panel = document.getElementById('filtrosPanel');
    const icon = document.getElementById('toggleIcon');
    if (panel.style.display === 'none') {
        panel.style.display = 'block';
        icon.classList.remove('fa-chevron-up');
        icon.classList.add('fa-chevron-down');
    } else {
        panel.style.display = 'none';
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    }
}

// Cambiar vista (grid o lista)
function cambiarVista(vista) {
    const gridView = document.getElementById('gridView');
    const listView = document.getElementById('listView');
    
    if (vista === 'grid') {
        gridView.classList.remove('hidden');
        listView.classList.add('hidden');
        localStorage.setItem('vistaCajas', 'grid');
    } else {
        gridView.classList.add('hidden');
        listView.classList.remove('hidden');
        localStorage.setItem('vistaCajas', 'list');
    }
}

// Cargar vista guardada
document.addEventListener('DOMContentLoaded', function() {
    const vistaGuardada = localStorage.getItem('vistaCajas');
    if (vistaGuardada === 'list') {
        cambiarVista('list');
    }
    
    // Si hay filtros aplicados, mantener panel abierto
    const hasFilters = '{{ request('numero_caja') || request('mes') || request('año') || request('fecha_desde') || request('fecha_hasta') }}';
    if (hasFilters) {
        document.getElementById('filtrosPanel').style.display = 'block';
    }
});
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-hover {
    transition: all 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
</style>
@endsection