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