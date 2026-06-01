<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    // Método privado para verificar autenticación (solo para métodos protegidos)
    private function checkAuth()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return null;
    }

    // ========== MÉTODOS PÚBLICOS (sin autenticación) ==========
    
    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'Las credenciales no coinciden.',
        ])->onlyInput('username');
    }

    // Mostrar formulario de registro (público)
    public function create()
    {
        return view('users.create');
    }

    // Guardar nuevo usuario (público)
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Crear el usuario
        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);

        // Opción 1: Auto-loguear al usuario (recomendado)
        Auth::login($user);
        
        return redirect()->intended('/dashboard')
            ->with('success', '¡Bienvenido! Tu cuenta ha sido creada exitosamente.');
        
        // Opción 2: Redirigir al login (comenta la línea anterior y descomenta esta)
        // return redirect()->route('login')
        //     ->with('success', 'Usuario creado exitosamente. Ahora inicia sesión.');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // ========== MÉTODOS PROTEGIDOS (requieren autenticación) ==========

    // Listar usuarios
    public function index(Request $request)
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;
        
        $query = User::query();
        
        if ($request->filled('search')) {
            $query->where('username', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%');
        }
        
        $users = $query->orderBy('created_at', 'desc')->paginate(15);
        
        return view('users.index', compact('users'));
    }

    // Mostrar un usuario
    public function show(User $user)
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;
        
        return view('users.show', compact('user'));
    }

    // Mostrar formulario editar usuario
    public function edit(User $user)
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;
        
        return view('users.edit', compact('user'));
    }

    // Actualizar usuario
    public function update(Request $request, User $user)
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;
        
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->username = $request->username;
        $user->name = $request->name;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }

    // Eliminar usuario
    public function destroy(User $user)
    {
        $redirect = $this->checkAuth();
        if ($redirect) return $redirect;
        
        // No permitir eliminar el propio usuario
        if ($user->id === Auth::id()) {
            return redirect()->route('users.index')
                ->with('error', 'No puedes eliminar tu propio usuario');
        }
        
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado exitosamente');
    }
}