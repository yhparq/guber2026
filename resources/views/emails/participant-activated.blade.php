<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a GUBER 2026</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #742284 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 32px;
            font-weight: bold;
            color: #bc8020;
        }
        .header p {
            margin: 10px 0 0 0;
            font-size: 18px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .welcome-message {
            background: #f3e8ff;
            border-left: 4px solid #742284;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .credentials-box {
            background: #f0f9ff;
            border: 2px solid #742284;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }
        .credentials-box h3 {
            color: #742284;
            margin-top: 0;
            font-size: 20px;
        }
        .credential-item {
            background: white;
            border: 1px solid #742284;
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .credential-label {
            font-weight: bold;
            color: #742284;
        }
        .credential-value {
            font-family: 'Courier New', monospace;
            background: #f3e8ff;
            padding: 5px 10px;
            border-radius: 3px;
            color: #742284;
            font-weight: bold;
        }
        .login-button {
            display: inline-block;
            background: linear-gradient(135deg, #bc8020 0%, #742284 100%);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .info-section {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .footer {
            background: #f1f5f9;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 5px 0;
            color: #64748b;
        }

        .highlight {
            color: #bc8020;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>GUBER 2026</h1>
            <p>XI CONVENCIÓN NACIONAL DE CONTABILIDAD GUBERNAMENTAL Y GESTIÓN PÚBLICA</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="welcome-message">
                <h2 style="color: #742284; margin-top: 0;">¡Bienvenido/a {{ $participant->nombres }} {{ $participant->apellidos }}!</h2>
                <p>Nos complace informarte que tu cuenta ha sido <span class="highlight">activada exitosamente</span> y ya tienes acceso al Aula Virtual de GUBER 2026.</p>
            </div>

            <p>Como parte de nuestra convención, ahora podrás acceder a todas las ponencias, materiales educativos y recursos disponibles en nuestra plataforma virtual.</p>

            <!-- Credentials Box -->
            <div class="credentials-box">
                <h3>🔑 Tus credenciales de acceso</h3>
                <div class="credential-item">
                    <span class="credential-label">Usuario (Email):</span>
                    <span class="credential-value">{{ $participant->email }}</span>
                </div>
                <div class="credential-item">
                    <span class="credential-label">Contraseña (DNI):</span>
                    <span class="credential-value">{{ $participant->dni }}</span>
                </div>
            </div>

            <!-- Login Button -->
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $loginUrl }}" class="login-button">
                    🚀 Acceder al Aula Virtual
                </a>
            </div>

            <!-- Information Section -->
            <div class="info-section">
                <h3 style="margin-top: 0; color: #92400e;">📚 ¿Qué encontrarás en el aula virtual?</h3>
                <ul style="margin: 10px 0; color: #92400e;">
                    <li><strong>Ponencias en vivo</strong> con expertos nacionales e internacionales</li>
                    <li><strong>Material descargable</strong> en formato PDF</li>
                    <li><strong>Cronograma detallado</strong> de los 3 días del evento</li>
                    <li><strong>Acceso exclusivo</strong> para participantes registrados</li>
                </ul>
            </div>

            <h3 style="color: #742284;">📞 Soporte técnico</h3>
            <p>Si tienes alguna dificultad para acceder o necesitas ayuda, no dudes en contactarnos:</p>
            <ul>
                <li><strong>Email:</strong> ccpmdd@gmail.com</li>
                <li><strong>Teléfono:</strong> +51 997 161 347</li>
                <li><strong>Horario:</strong> Lunes a Viernes de 9:00 AM a 6:00 PM</li>
            </ul>

            <p style="margin-top: 30px;">¡Estamos emocionados de tenerte como parte de GUBER 2026 y esperamos que disfrutes de esta experiencia de aprendizaje!</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>GUBER 2026</strong></p>
            <p>Colegio de Contadores Públicos de Madre de Dios</p>
            <p>© {{ date('Y') }} Todos los derechos reservados</p>
            <p style="font-size: 12px; margin-top: 15px;">
                Este es un correo automático, por favor no responder directamente a este mensaje.
            </p>
        </div>
    </div>
</body>
</html>
