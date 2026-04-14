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
        
        .bg-blanco {
            background-color: #FFFFFF;
        }
        
        .bg-gris-claro {
            background-color: #F5F5F5;
        }
        
        .bg-negro {
            background-color: #212121;
        }
        
        .text-negro {
            color: #212121;
        }
        
        .text-gris {
            color: #757575;
        }
        
        .border-gris {
            border-color: #E0E0E0;
        }
        
        .sidebar-link {
            transition: all 0.3s ease;
            border-radius: 12px;
            color: #424242;
        }
        
        .sidebar-link:hover {
            background-color: #F5F5F5;
            color: #212121;
            transform: translateX(5px);
        }
        
        .btn-primary {
            background-color: #212121;
            transition: all 0.3s ease;
            color: #FFFFFF;
        }
        
        .btn-primary:hover {
            background-color: #424242;
            transform: translateY(-2px);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="bg-gris-claro">
    
    @if(Auth::check())
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blanco text-negro fixed h-full shadow-md">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-10">
                    <div class="bg-negro p-2 rounded-xl">
                        <i class="fas fa-box text-white text-xl"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-negro">Sistema Cajas</span>
                        <span class="text-xs block text-gris">y Batches</span>
                    </div>
                </div>
                
                <nav class="space-y-2">
                    <a href="/dashboard" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('cajas.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg">
                        <i class="fas fa-boxes w-5"></i>
                        <span>Gestionar Cajas</span>
                    </a>
                </nav>
            </div>
            
            <div class="absolute bottom-0 w-full p-6">
                <div class="border-t border-gris pt-4">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-10 h-10 bg-gris-claro rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-negro"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-negro">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gris">{{ Auth::user()->username }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 rounded-lg bg-gris-claro hover:bg-gray-200 transition">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="flex-1 ml-64 overflow-y-auto">
            <main class="p-8">
                @if(session('success'))
                    <div class="bg-blanco border-l-4 border-negro text-negro px-4 py-3 rounded-lg mb-6 shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-blanco border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    @else
        <main>
            @yield('content')
        </main>
    @endif
</body>
</html>