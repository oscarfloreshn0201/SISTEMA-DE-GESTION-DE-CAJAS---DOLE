<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Caja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BatchController extends Controller
{
    // Mostrar formulario para crear batch (requiere caja_id)
    public function create(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $caja_id = $request->query('caja_id');
        $caja = Caja::findOrFail($caja_id);
        
        return view('batches.create', compact('caja'));
    }

    // Guardar nuevo batch
   public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect('/login');
    }
    
    // Verificar si es múltiple o individual
    if ($request->has('multiple') && $request->multiple == 1) {
        // Validar para múltiples batches
        $request->validate([
            'caja_id' => 'required|exists:cajas,id',
            'batches' => 'required|array|min:1',
            'batches.*.numero_batch' => 'required|string|max:255',
            'batches.*.folder' => 'required|string|max:255',
            'batches.*.categoria' => 'required|string|max:255',
            'batches.*.descripcion' => 'nullable|string'
        ]);
        
        $contador = 0;
        $errores = [];
        
        foreach ($request->batches as $batchData) {
            try {
                Batch::create([
                    'numero_batch' => $batchData['numero_batch'],
                    'folder' => $batchData['folder'],
                    'categoria' => $batchData['categoria'],
                    'descripcion' => $batchData['descripcion'] ?? null,
                    'caja_id' => $request->caja_id
                ]);
                $contador++;
            } catch (\Exception $e) {
                $errores[] = $batchData['numero_batch'];
            }
        }
        
        if ($contador > 0) {
            $mensaje = "Se crearon $contador batches exitosamente";
            if (count($errores) > 0) {
                $mensaje .= ". Errores con: " . implode(', ', $errores);
            }
            return redirect()->route('cajas.show', $request->caja_id)
                ->with('success', $mensaje);
        } else {
            return redirect()->route('cajas.show', $request->caja_id)
                ->with('error', 'No se pudo crear ningún batch');
        }
    } else {
        // Guardar batch individual (original)
        $validated = $request->validate([
            'numero_batch' => 'required|string|max:255',
            'folder' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'caja_id' => 'required|exists:cajas,id'
        ]);

        Batch::create($validated);

        return redirect()->route('cajas.show', $validated['caja_id'])
            ->with('success', 'Batch creado exitosamente');
    }
}

    // Mostrar un batch específico
    public function show(Batch $batch)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $batch->load('caja');
        return view('batches.show', compact('batch'));
    }

    // Mostrar formulario para editar batch
    public function edit(Batch $batch)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        return view('batches.edit', compact('batch'));
    }

    // Actualizar batch
    public function update(Request $request, Batch $batch)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $validated = $request->validate([
            'numero_batch' => 'required|string|max:255',
            'folder' => 'required|string|max:255',
            'categoria' => 'required|string|max:255',
            'descripcion' => 'nullable|string'
        ]);

        $batch->update($validated);

        return redirect()->route('cajas.show', $batch->caja_id)
            ->with('success', 'Batch actualizado exitosamente');
    }

    // Eliminar batch
    public function destroy(Batch $batch)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $caja_id = $batch->caja_id;
        $batch->delete();

        return redirect()->route('cajas.show', $caja_id)
            ->with('success', 'Batch eliminado exitosamente');
    }

    public function search(Request $request)
{
    if (!Auth::check()) {
        return redirect('/login');
    }
    
    $query = Batch::with('caja');
    
    if ($request->filled('numero_batch')) {
        $query->where('numero_batch', 'like', '%' . $request->numero_batch . '%');
    }
    
    if ($request->filled('categoria')) {
        $query->where('categoria', $request->categoria);
    }
    
    $batches = $query->orderBy('created_at', 'desc')->paginate(20);
    
    return view('batches.search', compact('batches'));
}
}