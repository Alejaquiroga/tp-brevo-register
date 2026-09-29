<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // 1. Importar
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable implements ShouldQueue // 2. Implementar ShouldQueue
{
    use Queueable, SerializesModels;

    public array $userData;
    public $tries = 3; // Intentos en caso de fallos SMTP

    public function __construct(array $userData)
    {
        $this->userData = $userData;
    }

    public function build(): self
    {
        return $this->subject('¡Bienvenido a nuestra plataforma!')
                    ->view('emails.welcome')
                    ->with(['nombre' => $this->userData['name']]);
    }
}