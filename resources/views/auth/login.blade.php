<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Cajas y Batches</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="gradient-bg">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-6xl w-full grid md:grid-cols-2 gap-8 bg-white rounded-2xl shadow-2xl overflow-hidden">
            <!-- Lado izquierdo - Imagen y texto -->
            <div class="gradient-bg p-8 flex flex-col justify-center items-center text-white">
                <div class="text-center">
                    <i class="fas fa-box text-7xl mb-6"></i>
                    <h1 class="text-3xl font-bold mb-4">Sistema de Cajas</h1>
                    <h2 class="text-2xl font-semibold mb-6">y Batches</h2>
                    <div class="w-24 h-1 bg-white/30 mx-auto mb-8"></div>
                    <div class="space-y-4 text-left">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-2xl"></i>
                            <span>Gestión completa de cajas</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-2xl"></i>
                            <span>Organización de batches</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-2xl"></i>
                            <span>Control total de inventario</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Lado derecho - Formulario de login -->
            <div class="p-8">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-800">Bienvenido</h3>
                    <p class="text-gray-500 mt-2">Ingresa tus credenciales</p>
                </div>
                
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-user mr-2"></i>Usuario
                        </label>
                        <input type="text" name="username" value="{{ old('username') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition"
                               placeholder="Ingresa tu usuario" required autofocus>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-2">
                            <i class="fas fa-lock mr-2"></i>Contraseña
                        </label>
                        <input type="password" name="password" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition"
                               placeholder="Ingresa tu contraseña" required>
                    </div>

                    <button type="submit" 
                            class="w-full gradient-bg text-white font-bold py-3 px-4 rounded-lg hover:shadow-lg transition transform hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Iniciar Sesión
                    </button>
                </form>
                
                <div class="mt-6 text-center text-sm text-gray-500">
                    <i class="fas fa-shield-alt mr-1"></i>
                    Sistema seguro
                </div>
            </div>
        </div>
    </div>
</body>
</html>