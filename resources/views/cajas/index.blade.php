@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Listado de Cajas</h2>
        <a href="{{ route('cajas.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            + Nueva Caja
        </a>
    </div>

    @if($cajas->isEmpty())
        <p class="text-gray-500 text-center py-8">No hay cajas registradas. Crea una nueva.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($cajas as $caja)
            <div class="border rounded-lg p-4 hover:shadow-lg transition">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-bold text-blue-600">
                            Caja #{{ $caja->numero_caja }}
                        </h3>
                        <p class="text-gray-600">
                            {{ $caja->nombre_mes }} {{ $caja->año }}
                        </p>
                        @if($caja->descripcion)
                            <p class="text-gray-500 text-sm mt-2">{{ $caja->descripcion }}</p>
                        @endif
                        <p class="text-sm text-gray-400 mt-2">
                            📄 {{ $caja->batches->count() }} batches
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('cajas.show', $caja) }}" 
                           class="text-blue-500 hover:text-blue-700">Ver</a>
                        <a href="{{ route('cajas.edit', $caja) }}" 
                           class="text-green-500 hover:text-green-700">Editar</a>
                        <form method="POST" action="{{ route('cajas.destroy', $caja) }}" 
                              onsubmit="return confirm('¿Eliminar esta caja? Se eliminarán todos sus batches')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection