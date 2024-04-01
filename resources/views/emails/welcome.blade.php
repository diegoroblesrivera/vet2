<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Mascot ID</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            margin: 20px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hola, {{ $user->full_name }}!</h1>
        <p>Te damos la bienvenida a nuestra aplicación. Estamos muy contentos de tenerte a bordo.</p>

        <p>Aquí tienes algunos enlaces que podrían interesarte:</p>
            Ya tienes acceso a nuestra plataforms
            Usuario : {{$user->email}}
            Contraseña : {{$user->hash(password)}}

        <ul>
            <li><a href="{{ url('/dashboard') }}">Tu Dashboard</a></li>
            <li><a href="{{ url('/profile') }}">Configura tu perfil</a></li>
        </ul>

        <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>

        <p>Saludos,</p>
        <p>El Equipo de New Vet</p>
    </div>
</body>
</html>
