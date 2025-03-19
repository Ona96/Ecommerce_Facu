<!DOCTYPE html>
<html>
<head>
    <title>Bienvenido a Venecia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3490dc;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .button {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>¡Bienvenido a Venecia!</h1>
    </div>
    
    <div class="content">
        <h2>Hola {{ $usuario->nombre }},</h2>
        
        <p>¡Gracias por registrarte en nuestra tienda en línea!</p>
        
        <p>Estamos emocionados de tenerte como parte de nuestra comunidad. En Venecia encontrarás los mejores productos con precios increíbles.</p>
        
        <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.</p>
        
        <a href="{{ url('/') }}" class="button">Visitar la Tienda</a>
        
        <p>Saludos,<br>El equipo de Venecia</p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} Venecia. Todos los derechos reservados.</p>
    </div>
</body>
</html>