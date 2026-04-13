@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-azul-marino">
            <i class="fas fa-users mr-2"></i>Gestión de Usuarios
        </h2>
        <a href="{{ route('users.create') }}" class="btn-primary text-white px-4 py-2 rounded-lg">
            <i class="fas fa-user-plus mr-1"></i> Nuevo Usuario
        </a>
    </div>

    <!-- Filtros -->
    <div class="bg-gradient-to-r from-azul-celeste to-white rounded-xl p-4 mb-6">
        <form method="GET" action="{{ route('users.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-azul-marino mb-1">Buscar Usuario</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-azul-principal"
                       placeholder="Nombre o username...">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="btn-primary text-white px-4 py-2 rounded-lg">
                    <i class="fas fa-search mr-1"></i> Buscar
                </button>
                <a href="{{ route('users.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
                    <i class="fas fa-undo mr-1"></i> Limpiar
                </a>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded mb-4">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded mb-4">
            <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
        </div>
    @endif

    @if($users->isEmpty())
        <div class="text-center py-12 bg-gray-50 rounded-lg">
            <i class="fas fa-users-slash text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No hay usuarios registrados</p>
            <a href="{{ route('users.create') }}" class="inline-block mt-3 text-azul-principal hover:underline">
                Crear el primer usuario
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg">
                <thead>
                    <tr class="bg-amarillo-palido">
                        <th class="py-3 px-4 border text-left">ID</th>
                        <th class="py-3 px-4 border text-left">Usuario</th>
                        <th class="py-3 px-4 border text-left">Nombre Completo</th>
                        <th class="py-3 px-4 border text-left">Fecha Registro</th>
                        <th class="py-3 px-4 border text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-2 px-4 border">{{ $user->id }}</td>
                        <td class="py-2 px-4 border">
                            <div class="flex items-center gap-2">
                                <div class="gradient-azul w-8 h-8 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white text-sm"></i>
                                </div>
                                <span class="font-medium">{{ $user->username }}</span>
                            </div>
                        </td>
                        <td class="py-2 px-4 border">{{ $user->name }}</td>
                        <td class="py-2 px-4 border">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-2 px-4 border text-center">
                            <div class="flex gap-2 justify-center">
                                <button onclick="verUsuario({{ $user->id }})" 
                                        class="text-azul-principal hover:text-azul-marino" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button onclick="editarUsuario({{ $user->id }})" 
                                        class="text-yellow-500 hover:text-yellow-700" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @if($user->id !== Auth::id())
                                <form method="POST" action="{{ route('users.destroy', $user) }}" 
                                      onsubmit="return confirm('¿Eliminar este usuario?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $users->appends(request()->query())->links() }}
        </div>
    @endif
</div>

<script>
function verUsuario(id) {
    window.location.href = '/users/' + id;
}

function editarUsuario(id) {
    window.location.href = '/users/' + id + '/edit';
}
</script>

<style>
.gradient-azul {
    background: linear-gradient(135deg, #87CEEB 0%, #4A90E2 100%);
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