@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold">Agregar Batch</h2>
            <p class="text-gray-600">Para la caja: <strong>{{ $caja->display_name }}</strong></p>
        </div>
        <a href="{{ route('cajas.show', $caja) }}" class="text-gray-500 hover:text-gray-700">← Volver</a>
    </div>

    <form method="POST" action="{{ route('batches.store') }}">
        @csrf
        
        <input type="hidden" name="caja_id" value="{{ $caja->id }}">

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Número de Batch</label>
            <input type="text" name="numero_batch" value="{{ old('numero_batch') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                   required>
            @error('numero_batch')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Folder</label>
            <input type="text" name="folder" value="{{ old('folder') }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                   required>
            @error('folder')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

      <div class="mb-4">
    <label class="block text-gray-700 font-bold mb-2">Categoría</label>
    <select name="categoria" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
            required>
        <option value="" disabled {{ old('categoria') ? '' : 'selected' }}>🔽 Seleccionar categoría</option>
        <option value="Samyra" {{ old('categoria') == 'Samyra' ? 'selected' : '' }}>👤 Samyra</option>
        <option value="Contable" {{ old('categoria') == 'Contable' ? 'selected' : '' }}>📊 Contable</option>
        <option value="Agencia Bautista" {{ old('categoria') == 'Agencia Bautista' ? 'selected' : '' }}>⛪ Agencia Bautista</option>
        <option value="ONASA" {{ old('categoria') == 'ONASA' ? 'selected' : '' }}>🏥 ONASA</option>
        <option value="Materiales" {{ old('categoria') == 'Materiales' ? 'selected' : '' }}>🔧 Materiales</option>
        <option value="Documentos de Cierre" {{ old('categoria') == 'Documentos de Cierre' ? 'selected' : '' }}>🔒 Documentos de Cierre</option>
        <option value="IP" {{ old('categoria') == 'IP' ? 'selected' : '' }}>🌐 IP</option>
    </select>
    @error('categoria')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Descripción</label>
            <textarea name="descripcion" rows="3" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('descripcion') }}</textarea>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                Guardar Batch
            </button>
            <a href="{{ route('cajas.show', $caja) }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection