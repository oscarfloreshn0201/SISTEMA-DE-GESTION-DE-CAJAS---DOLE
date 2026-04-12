<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CajaController extends Controller
{
    // Listar todas las cajas

    public function index(Request $request)
{
    if (!Auth::check()) {
        return redirect('/login');
    }
    
    $query = Caja::with('batches');
    
    // Filtrar por número de caja
    if ($request->filled('numero_caja')) {
        $query->where('numero_caja', 'like', '%' . $request->numero_caja . '%');
    }
    
    // Filtrar por mes
    if ($request->filled('mes')) {
        $query->where('mes', $request->mes);
    }
    
    // Filtrar por año
    if ($request->filled('año')) {
        $query->where('año', $request->año);
    }
    
    $cajas = $query->orderBy('created_at', 'desc')->paginate(12);
    
    return view('cajas.index', compact('cajas'));
}
  
    // Mostrar formulario para crear caja
    public function create()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        return view('cajas.create');
    }

    // Guardar nueva caja
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $validated = $request->validate([
            'numero_caja' => 'required|string|max:255|unique:cajas',
            'mes' => 'required|integer|between:1,12',
            'año' => 'required|integer|min:2000|max:2100',
            'descripcion' => 'nullable|string'
        ]);

        Caja::create($validated);

        return redirect()->route('cajas.index')
            ->with('success', 'Caja creada exitosamente');
    }

    // Mostrar una caja específica con sus batches
    public function show(Caja $caja)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $caja->load('batches');
        return view('cajas.show', compact('caja'));
    }

    // Mostrar formulario para editar caja
    public function edit(Caja $caja)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        return view('cajas.edit', compact('caja'));
    }

    // Actualizar caja
    public function update(Request $request, Caja $caja)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $validated = $request->validate([
            'numero_caja' => 'required|string|max:255|unique:cajas,numero_caja,' . $caja->id,
            'mes' => 'required|integer|between:1,12',
            'año' => 'required|integer|min:2000|max:2100',
            'descripcion' => 'nullable|string'
        ]);

        $caja->update($validated);

        return redirect()->route('cajas.index')
            ->with('success', 'Caja actualizada exitosamente');
    }

    // Eliminar caja
    public function destroy(Caja $caja)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $caja->delete();

        return redirect()->route('cajas.index')
            ->with('success', 'Caja eliminada exitosamente');
    }
}