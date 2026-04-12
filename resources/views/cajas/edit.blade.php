@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Editar Caja</h2>
        <a href="{{ route('cajas.index') }}" class="text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <form method="POST" action="{{ route('cajas.update', $caja) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Número de Caja</label>
            <input type="text" name="numero_caja" value="{{ old('numero_caja', $caja->numero_caja) }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                   required>
            @error('numero_caja')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2">Mes</label>
                <select name="mes" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
                    <option value="">Seleccionar mes</option>
                    <option value="1" {{ old('mes', $caja->mes) == 1 ? 'selected' : '' }}>Enero</option>
                    <option value="2" {{ old('mes', $caja->mes) == 2 ? 'selected' : '' }}>Febrero</option>
                    <option value="3" {{ old('mes', $caja->mes) == 3 ? 'selected' : '' }}>Marzo</option>
                    <option value="4" {{ old('mes', $caja->mes) == 4 ? 'selected' : '' }}>Abril</option>
                    <option value="5" {{ old('mes', $caja->mes) == 5 ? 'selected' : '' }}>Mayo</option>
                    <option value="6" {{ old('mes', $caja->mes) == 6 ? 'selected' : '' }}>Junio</option>
                    <option value="7" {{ old('mes', $caja->mes) == 7 ? 'selected' : '' }}>Julio</option>
                    <option value="8" {{ old('mes', $caja->mes) == 8 ? 'selected' : '' }}>Agosto</option>
                    <option value="9" {{ old('mes', $caja->mes) == 9 ? 'selected' : '' }}>Septiembre</option>
                    <option value="10" {{ old('mes', $caja->mes) == 10 ? 'selected' : '' }}>Octubre</option>
                    <option value="11" {{ old('mes', $caja->mes) == 11 ? 'selected' : '' }}>Noviembre</option>
                    <option value="12" {{ old('mes', $caja->mes) == 12 ? 'selected' : '' }}>Diciembre</option>
                </select>
                @error('mes')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Año</label>
                <input type="number" name="año" value="{{ old('año', $caja->año) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                       required>
                @error('año')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Descripción</label>
            <textarea name="descripcion" rows="3" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('descripcion', $caja->descripcion) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            Actualizar Caja
        </button>
    </form>
</div>
@endsection