<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Agendado()
 * @method static static Procesando()
 * @method static static Approved()
 * @method static static Cancel()
 * @method static static Atendido()
 * @method static static Exploracion()
 */
final class ServiceStatus extends Enum
{
    const Agendado =   0;
    const RecordatorioEnviado =   1;
    const Confirmado = 2;
    const Cancel = 3;
    const Ensala= 4;
    const EnBox = 5;
    const Atendido = 6;
    const Hospitalizacion = 7;
    const EnCirugia = 8;
    
}
