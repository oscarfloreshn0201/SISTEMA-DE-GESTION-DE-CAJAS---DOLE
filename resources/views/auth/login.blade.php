<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Cajas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        * { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body style="background-color: #F5F5F5;">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full" style="background-color: #FFFFFF; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">
            
            <!-- Header con logo - CORREGIDO -->
            <div style="background-color: #212121; padding: 32px; text-align: center;">
                <!-- Logo sin forzar - tamaño proporcionado -->
                <img src="{{ asset('img/Dole-logo.png') }}" alt="Logo" 
                     style="max-width: 100px; height: auto; margin: 0 auto 16px auto; display: block;">
                <h1 style="color: #FFFFFF; font-size: 24px; font-weight: bold; margin: 0;">Sistema de Cajas</h1>
                <p style="color: #BDBDBD; font-size: 14px; margin-top: 4px;">y Batches</p>
            </div>
            
            <!-- Formulario -->
            <div style="padding: 32px;">
                <h3 style="color: #212121; font-size: 20px; font-weight: bold; text-align: center; margin-bottom: 24px;">Iniciar Sesión</h3>
                
                @if ($errors->any())
                    <div style="background-color: #F5F5F5; border-left: 4px solid #EF5350; padding: 12px; border-radius: 8px; margin-bottom: 20px;">
                        @foreach ($errors->all() as $error)
                            <div style="display: flex; align-items: center; color: #C62828; font-size: 14px;">
                                <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                                {{ $error }}
                            </div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; color: #212121; font-weight: 600; margin-bottom: 8px;">Usuario</label>
                        <input type="text" name="username" value="{{ old('username') }}" 
                               style="width: 100%; padding: 12px; border: 1px solid #E0E0E0; border-radius: 8px; outline: none;"
                               onfocus="this.style.borderColor='#212121'"
                               onblur="this.style.borderColor='#E0E0E0'"
                               required autofocus>
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label style="display: block; color: #212121; font-weight: 600; margin-bottom: 8px;">Contraseña</label>
                        <input type="password" name="password" 
                               style="width: 100%; padding: 12px; border: 1px solid #E0E0E0; border-radius: 8px; outline: none;"
                               onfocus="this.style.borderColor='#212121'"
                               onblur="this.style.borderColor='#E0E0E0'"
                               required>
                    </div>

                    <button type="submit" 
                            style="width: 100%; background-color: #212121; color: #FFFFFF; font-weight: bold; padding: 12px; border: none; border-radius: 8px; cursor: pointer; transition: all 0.3s;"
                            onmouseover="this.style.backgroundColor='#424242'"
                            onmouseout="this.style.backgroundColor='#212121'">
                        Iniciar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>