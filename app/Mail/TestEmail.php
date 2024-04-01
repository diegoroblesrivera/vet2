<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $param1;
    public $param2;
    public $param3;
    public $param4;
    public $param5;
    public $param6;

    public function __construct($param1, $param2,$param3,$param4, $param5, $param6)
    {
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->param3 = $param3;
        $this->param4 = $param4;
        $this->param5 = $param5;
        $this->param6 = $param6;
    }

    public function build()
    {
        return $this->subject('Prueba de Email')
                    ->view('emails.test');
    }
}
