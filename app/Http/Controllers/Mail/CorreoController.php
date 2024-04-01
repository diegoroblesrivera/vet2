<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;

class CorreoController extends Controller
{
    public function enviarCorreoHTML($destinatario, $asunto, $nombreDestinatario)
    {
        // Renderizar la vista 'correo' y obtener el HTML
        $contenido = view('correo', ['nombre' => $nombreDestinatario])->render();

        // Envío del correo electrónico
        Mail::send([], [], function (Message $message) use ($destinatario, $asunto, $contenido) {
            $message->to($destinatario)
                ->subject($asunto)
                ->setBody($contenido, 'text/html');
        });
    }
}
