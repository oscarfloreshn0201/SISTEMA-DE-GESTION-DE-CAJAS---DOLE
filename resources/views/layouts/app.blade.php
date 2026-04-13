<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cajas y Batches</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .sidebar-link {
            transition: all 0.3s ease;
        }
        
        .sidebar-link:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: translateX(5px);
        }
    </style>
</head>
<body class="bg-gray-50">
    
    @if(Auth::check())
    <!-- Sidebar para usuarios autenticados -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 gradient-bg text-white fixed h-full shadow-xl">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-8">
                    <i class="fas fa-box text-2xl"></i>
                    <span class="text-xl font-bold">Sistema Cajas</span>
                </div>
                
                <nav class="space-y-2">
                    <a href="/dashboard" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="/cajas" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                        <i class="fas fa-boxes"></i>
                        <span>Gestionar Cajas</span>
                    </a>

                    
                </nav>
            </div>
            
            <div class="absolute bottom-0 w-full p-6">
                <div class="border-t border-white/20 pt-4">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <p class="font-semibold">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-white/70">{{ Auth::user()->username }}</p>
                        </div>
                    </div>
                    <form method="POST" action="/logout">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 rounded-lg bg-red-500/20 hover:bg-red-500/30 transition">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <main class="p-8">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-6 shadow-md">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    @else
        <!-- Sin sidebar para login -->
        <main>
            @yield('content')
        </main>
    @endif
</body>
</html>