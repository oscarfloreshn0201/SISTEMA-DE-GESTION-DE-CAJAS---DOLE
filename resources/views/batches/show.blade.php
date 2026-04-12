@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Detalle del Batch</h2>
        <a href="{{ route('cajas.show', $batch->caja) }}" class="text-gray-500 hover:text-gray-700">← Volver a la Caja</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="border rounded-lg p-4">
            <p class="text-sm text-gray-500">Número de Batch</p>
            <p class="text-xl font-bold">{{ $batch->numero_batch }}</p>
        </div>

        <div class="border rounded-lg p-4">
            <p class="text-sm text-gray-500">Caja Padre</p>
            <p class="text-xl font-bold">{{ $batch->caja->display_name }}</p>
        </div>

        <div class="border rounded-lg p-4">
            <p class="text-sm text-gray-500">Folder</p>
            <p class="text-lg">{{ $batch->folder }}</p>
        </div>

        <div class="border rounded-lg p-4">
            <p class="text-sm text-gray-500">Categoría</p>
            <p class="text-lg">{{ $batch->categoria }}</p>
        </div>

        @if($batch->descripcion)
        <div class="border rounded-lg p-4 md:col-span-2">
            <p class="text-sm text-gray-500">Descripción</p>
            <p class="text-lg">{{ $batch->descripcion }}</p>
        </div>
        @endif

        <div class="border rounded-lg p-4">
            <p class="text-sm text-gray-500">Fecha de Creación</p>
            <p class="text-lg">{{ $batch->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="border rounded-lg p-4">
            <p class="text-sm text-gray-500">Última Actualización</p>
            <p class="text-lg">{{ $batch->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-6 flex gap-2">
        <a href="{{ route('batches.edit', $batch) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600">
            Editar Batch
        </a>
        <form method="POST" action="{{ route('batches.destroy', $batch) }}" 
              onsubmit="return confirm('¿Eliminar este batch?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                Eliminar Batch
            </button>
        </form>
    </div>
</div>
@endsection