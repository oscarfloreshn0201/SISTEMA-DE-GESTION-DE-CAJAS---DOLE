@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-azul-marino">{{ $caja->display_name }}</h2>
            @if($caja->descripcion)
                <p class="text-gray-600 mt-1">{{ $caja->descripcion }}</p>
            @endif
        </div>
        <div class="flex gap-2">
            <a href="{{ route('cajas.edit', $caja) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
                <i class="fas fa-edit mr-1"></i> Editar Caja
            </a>
            <a href="{{ route('cajas.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                <i class="fas fa-arrow-left mr-1"></i> Volver
            </a>
        </div>
    </div>

    <!-- Información de la caja -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 p-4 bg-gray-50 rounded-lg">
        <div>
            <p class="text-sm text-gray-500">Número de Caja</p>
            <p class="text-xl font-bold text-azul-marino">{{ $caja->numero_caja }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Mes</p>
            <p class="text-xl font-bold text-azul-marino">{{ $caja->nombre_mes }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Año</p>
            <p class="text-xl font-bold text-azul-marino">{{ $caja->año }}</p>
        </div>
    </div>

    <!-- Sección de batches -->
    <div class="mt-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-azul-marino">
                <i class="fas fa-tags mr-2"></i>Batches en esta Caja
            </h3>
            <div class="flex gap-2">
                <div class="relative">
                    <input type="text" id="searchBatch" placeholder="Buscar batch..." 
                           class="pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal focus:ring-2 focus:ring-azul-celeste text-sm w-64">
                    <i class="fas fa-search absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                </div>
                <a href="{{ route('batches.create', ['caja_id' => $caja->id]) }}" 
                   class="btn-primary text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-plus mr-1"></i> Agregar Batch
                </a>


                
            </div>
        </div>

        @if($caja->batches->isEmpty())
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <i class="fas fa-folder-open text-5xl text-gray-300 mb-3"></i>
                <p class="text-gray-500">No hay batches en esta caja</p>
                <a href="{{ route('batches.create', ['caja_id' => $caja->id]) }}" 
                   class="inline-block mt-3 text-azul-principal hover:underline">
                    Agregar el primer batch
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded-lg">
                    <thead>
                        <tr class="bg-amarillo-palido">
                            <th class="py-3 px-4 border text-left">Número Batch</th>
                            <th class="py-3 px-4 border text-left">Folder</th>
                            <th class="py-3 px-4 border text-left">Categoría</th>
                            <th class="py-3 px-4 border text-left">Descripción</th>
                            <th class="py-3 px-4 border text-center">Acciones</th>
                         </tr>
                    </thead>
                    <tbody>
                        @foreach($caja->batches as $batch)
                        <tr class="batch-row hover:bg-gray-50 transition">
                            <td class="py-2 px-4 border batch-numero font-medium">{{ $batch->numero_batch }}</td>
                            <td class="py-2 px-4 border batch-folder">{{ $batch->folder }}</td>
                            <td class="py-2 px-4 border batch-categoria">
                                @switch($batch->categoria)
                                    @case('Samyra') 👤 @break
                                    @case('Contable') 📊 @break
                                    @case('Agencia Bautista') ⛪ @break
                                    @case('ONASA') 🏥 @break
                                    @case('Materiales') 🔧 @break
                                    @case('Documentos de Cierre') 🔒 @break
                                    @case('IP') 🌐 @break
                                    @default 📄
                                @endswitch
                                {{ $batch->categoria }}
                            </td>
                            <td class="py-2 px-4 border">{{ $batch->descripcion ?? '-' }}</td>
                            <td class="py-2 px-4 border text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="{{ route('batches.show', $batch) }}" class="text-azul-principal hover:text-azul-marino" title="Ver">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('batches.edit', $batch) }}" class="text-yellow-500 hover:text-yellow-700" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('batches.destroy', $batch) }}" 
                                          onsubmit="return confirm('¿Eliminar este batch?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Eliminar">
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
            
            <div class="mt-3 text-sm text-gray-500" id="batchCount">
                Mostrando {{ $caja->batches->count() }} batches
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchBatch');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase().trim();
            let rows = document.querySelectorAll('.batch-row');
            let visibleCount = 0;
            
            rows.forEach(row => {
                let numero = row.querySelector('.batch-numero')?.textContent.toLowerCase() || '';
                let folder = row.querySelector('.batch-folder')?.textContent.toLowerCase() || '';
                let categoria = row.querySelector('.batch-categoria')?.textContent.toLowerCase() || '';
                
                if (searchValue === '') {
                    row.style.display = '';
                    visibleCount++;
                } else if (numero.includes(searchValue) || folder.includes(searchValue) || categoria.includes(searchValue)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            const countElement = document.getElementById('batchCount');
            if (countElement) {
                if (searchValue === '') {
                    countElement.innerHTML = `Mostrando ${rows.length} batches`;
                } else {
                    countElement.innerHTML = `Mostrando ${visibleCount} de ${rows.length} batches`;
                }
            }
        });
    }
});
</script>
@endsection