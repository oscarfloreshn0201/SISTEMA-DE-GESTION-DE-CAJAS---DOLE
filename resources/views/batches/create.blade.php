@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-azul-marino">
                <i class="fas fa-layer-group mr-2"></i>Agregar Batches
            </h2>
            <p class="text-gray-600 mt-1">
                Caja: <strong class="text-azul-principal">{{ $caja->display_name }}</strong>
            </p>
        </div>
        <a href="{{ route('cajas.show', $caja) }}" class="text-gray-500 hover:text-gray-700">
            ← Volver a la Caja
        </a>
    </div>

    <!-- Formulario para múltiples batches -->
    <form method="POST" action="{{ route('batches.store') }}" id="multipleBatchesForm">
        @csrf
        <input type="hidden" name="caja_id" value="{{ $caja->id }}">
        <input type="hidden" name="multiple" value="1">

        <div class="mb-4">
            <div class="flex justify-between items-center mb-3">
                <h3 class="text-lg font-semibold text-azul-marino">
                    <i class="fas fa-list mr-2"></i>Lista de Batches
                </h3>
                <button type="button" onclick="agregarFila()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                    <i class="fas fa-plus mr-1"></i> Agregar Batch
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border rounded-lg" id="batchesTable">
                    <thead class="bg-amarillo-palido">
                        <tr>
                            <th class="py-2 px-3 border text-left text-sm">Número Batch</th>
                            <th class="py-2 px-3 border text-left text-sm">Folder</th>
                            <th class="py-2 px-3 border text-left text-sm">Categoría</th>
                            <th class="py-2 px-3 border text-left text-sm">Descripción</th>
                            <th class="py-2 px-3 border text-center text-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="batchesBody">
                        <!-- Fila 1 (por defecto) -->
                        <tr class="batch-row">
                            <td class="py-2 px-3 border">
                                <input type="text" name="batches[0][numero_batch]" 
                                       class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:border-azul-principal text-sm"
                                       placeholder="Ej: BATCH-001" required>
                            </td>
                            <td class="py-2 px-3 border">
                                <input type="text" name="batches[0][folder]" 
                                       class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:border-azul-principal text-sm"
                                       placeholder="Carpeta" required>
                            </td>
                            <td class="py-2 px-3 border">
                                <select name="batches[0][categoria]" 
                                        class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:border-azul-principal text-sm"
                                        required>
                                    <option value="">Seleccionar</option>
                                    <option value="Samyra">👤 Samyra</option>
                                    <option value="Contable">📊 Contable</option>
                                    <option value="Agencia Bautista">⛪ Agencia Bautista</option>
                                    <option value="ONASA">🏥 ONASA</option>
                                    <option value="Materiales">🔧 Materiales</option>
                                    <option value="Documentos de Cierre">🔒 Documentos de Cierre</option>
                                    <option value="IP">🌐 IP</option>
                                </select>
                            </td>
                            <td class="py-2 px-3 border">
                                <textarea name="batches[0][descripcion]" rows="1" 
                                          class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:border-azul-principal text-sm"
                                          placeholder="Descripción (opcional)"></textarea>
                            </td>
                            <td class="py-2 px-3 border text-center">
                                <button type="button" onclick="eliminarFila(this)" class="text-red-500 hover:text-red-700" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray-50">
                            <td colspan="4" class="py-2 px-3 border">
                                <span class="text-sm text-gray-600" id="batchCount">1 batch(es) para agregar</span>
                            </td>
                            <td class="py-2 px-3 border text-center">
                                <button type="button" onclick="agregarFila()" class="text-green-500 hover:text-green-700">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="flex gap-3 mt-6">
            <button type="submit" class="btn-primary text-white px-6 py-2 rounded-lg hover:shadow-lg transition">
                <i class="fas fa-save mr-2"></i> Guardar Todos los Batches
            </button>
            <a href="{{ route('cajas.show', $caja) }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
                Cancelar
            </a>
        </div>
    </form>
</div>

<script>
let rowCount = 1;

function agregarFila() {
    const tbody = document.getElementById('batchesBody');
    const newRow = document.createElement('tr');
    newRow.className = 'batch-row';
    newRow.innerHTML = `
        <td class="py-2 px-3 border">
            <input type="text" name="batches[${rowCount}][numero_batch]" 
                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:border-azul-principal text-sm"
                   placeholder="Ej: BATCH-00${rowCount + 1}" required>
        </td>
        <td class="py-2 px-3 border">
            <input type="text" name="batches[${rowCount}][folder]" 
                   class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:border-azul-principal text-sm"
                   placeholder="Carpeta" required>
        </td>
        <td class="py-2 px-3 border">
            <select name="batches[${rowCount}][categoria]" 
                    class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:border-azul-principal text-sm"
                    required>
                <option value="">Seleccionar</option>
                <option value="Samyra">👤 Samyra</option>
                <option value="Contable">📊 Contable</option>
                <option value="Agencia Bautista">⛪ Agencia Bautista</option>
                <option value="ONASA">🏥 ONASA</option>
                <option value="Materiales">🔧 Materiales</option>
                <option value="Documentos de Cierre">🔒 Documentos de Cierre</option>
                <option value="IP">🌐 IP</option>
            </select>
        </td>
        <td class="py-2 px-3 border">
            <textarea name="batches[${rowCount}][descripcion]" rows="1" 
                      class="w-full px-2 py-1 border border-gray-300 rounded focus:outline-none focus:border-azul-principal text-sm"
                      placeholder="Descripción (opcional)"></textarea>
        </td>
        <td class="py-2 px-3 border text-center">
            <button type="button" onclick="eliminarFila(this)" class="text-red-500 hover:text-red-700" title="Eliminar">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    tbody.appendChild(newRow);
    rowCount++;
    actualizarContador();
}

function eliminarFila(button) {
    const row = button.closest('tr');
    row.remove();
    actualizarContador();
    
    // Renumerar los índices
    const rows = document.querySelectorAll('#batchesBody .batch-row');
    rows.forEach((row, index) => {
        const inputs = row.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const newName = name.replace(/\[\d+\]/, `[${index}]`);
                input.setAttribute('name', newName);
            }
        });
    });
    rowCount = rows.length;
}

function actualizarContador() {
    const rows = document.querySelectorAll('#batchesBody .batch-row');
    const countElement = document.getElementById('batchCount');
    countElement.textContent = `${rows.length} batch(es) para agregar`;
}

// Validar que no haya duplicados antes de enviar
document.getElementById('multipleBatchesForm').addEventListener('submit', function(e) {
    const numeros = [];
    const rows = document.querySelectorAll('#batchesBody .batch-row');
    
    rows.forEach(row => {
        const numeroInput = row.querySelector('input[name*="numero_batch"]');
        if (numeroInput && numeroInput.value) {
            if (numeros.includes(numeroInput.value)) {
                e.preventDefault();
                alert('Error: Hay números de batch duplicados. Por favor, verifica.');
                numeroInput.focus();
                return false;
            }
            numeros.push(numeroInput.value);
        }
    });
});
</script>

<style>
.batch-row input:focus, .batch-row select:focus, .batch-row textarea:focus {
    border-color: #4A90E2;
    ring: 2px solid #87CEEB;
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