<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Login | Panel Moderno</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #0f0f1a;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      position: relative;
      overflow: hidden;
    }

    body::before {
      content: '';
      position: absolute;
      width: 300px;
      height: 300px;
      background: radial-gradient(circle, rgba(102,126,234,0.3) 0%, rgba(118,75,162,0) 70%);
      top: -100px;
      right: -100px;
      border-radius: 50%;
    }

    body::after {
      content: '';
      position: absolute;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(118,75,162,0.2) 0%, rgba(102,126,234,0) 70%);
      bottom: -150px;
      left: -150px;
      border-radius: 50%;
    }

    .login-container {
      width: 100%;
      max-width: 480px;
      position: relative;
      z-index: 1;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(10px);
      border-radius: 48px;
      padding: 48px 40px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s ease;
    }

    .login-card:hover {
      transform: translateY(-5px);
    }

    .custom-logo {
      text-align: center;
      margin-bottom: 32px;
    }
    
    .custom-logo img {
      max-width: 180px;
      width: auto;
      height: auto;
      display: inline-block;
      border-radius: 24px;
      box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease;
    }
    
    .custom-logo img:hover {
      transform: scale(1.05);
    }

    .login-header {
      text-align: center;
      margin-bottom: 36px;
    }
    
    .login-header h1 {
      font-size: 32px;
      font-weight: 700;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 10px;
    }
    
    .login-header p {
      color: #6b7280;
      font-size: 15px;
      font-weight: 400;
    }

    .input-group {
      margin-bottom: 20px;
    }
    
    .input-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #374151;
      margin-bottom: 8px;
    }
    
    .input-icon {
      position: relative;
      display: flex;
      align-items: center;
    }
    
    .input-icon i {
      position: absolute;
      left: 16px;
      color: #9ca3af;
      font-size: 18px;
      transition: color 0.2s;
      pointer-events: none;
    }
    
    .input-icon input {
      width: 100%;
      padding: 14px 16px 14px 48px;
      border: 2px solid #e5e7eb;
      border-radius: 20px;
      font-size: 15px;
      font-family: 'Inter', sans-serif;
      font-weight: 500;
      transition: all 0.2s ease;
      background: #f9fafb;
      outline: none;
      color: #1f2937;
    }
    
    .input-icon input:focus {
      border-color: #667eea;
      background: white;
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }
    
    .input-icon input:focus + i {
      color: #667eea;
    }

    .login-btn {
      width: 100%;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      padding: 15px;
      border-radius: 24px;
      color: white;
      font-size: 16px;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 10px;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }
    
    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
    }
    
    .login-btn:active {
      transform: translateY(1px);
    }

    @media (max-width: 500px) {
      .login-card {
        padding: 32px 24px;
      }
      .custom-logo img {
        max-width: 120px;
      }
      .login-header h1 {
        font-size: 28px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="custom-logo">
        <img src="{{ asset('img/Dole-logo.png') }}" alt="Logo Personalizado">
      </div>

      <div class="login-header">
        <h1>Bienvenido</h1>
        <p>Ingresa a tu cuenta para continuar</p>
      </div>

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group">
          <label>Usuario o correo</label>
          <div class="input-icon">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Ingresa tu usuario" required>
          </div>
        </div>
        <div class="input-group">
          <label>Contraseña</label>
          <div class="input-icon">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="••••••••" required>
          </div>
        </div>

        <button type="submit" class="login-btn">Iniciar sesión</button>
      </form>
    </div>
  </div>
</body>
</html>