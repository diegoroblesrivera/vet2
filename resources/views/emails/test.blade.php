<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

        <title>Correo de ejemplo</title>
    </head>
    <body>
        <p style="text-align: center;"><strong><span style="font-size: 20px;">Bienvenido a &nbsp;Facil Vet</span></strong></p>
        <p>Su cit&aacute; ha sido agendada con el detalle a continuacion</p>
        <p><br></p>
        <table style="width: 50%;">
            <tbody>
                <tr>
                    <td style="width: 50.0000%;">Dia</td>
                    <td style="width: 50.0000%;"><br>{{$param1}}</td>
                </tr>
                <tr>
                    <td style="width: 50.0000%;">Hora</td>
                    <td style="width: 50.0000%;"><br>{{$param2}}</td>
                </tr>
                {{-- <tr>
                    <td style="width: 50.0000%;">Doctor</td>
                    <td style="width: 50.0000%;"><br>{{$param3}}</td>
                </tr> --}}
                <tr>
                    <td style="width: 50.0000%;">Nombre Cliente</td>
                    <td style="width: 50.0000%;"><br>{{$param4}}</td>
                </tr>
                <tr>
                    <td style="width: 50.0000%;">Nombre Mascota</td>
                    <td style="width: 50.0000%;"><br>{{$param5}}</td>
                </tr>
                <tr>
                    <td style="width: 50.0000%;">Motivo</td>
                    <td style="width: 50.0000%;"><br>{{$param6}}</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            Su cuenta fue creada y ya puede acceder
            <div>
                Usuario : {{$param3}}
            </div>
            <div>
                Password : 123456 ( se recomienda actulizar clave)
            </div>
            Ingrese con el link a continuación.
            <br>
                    <div class="center">
                        <a href="https://go.vety.cl/login"> <button type="button" class="btn btn-primary">Entrar a su cuenta</button></a>
                    </div>
        </div>
        
        <p>Le recomendamos llegar 20 minutos antes de la cita para no tener problemas de ingreso.</p>
        <p>Que tenga buen dia.</p>
    </body>
    </html>


