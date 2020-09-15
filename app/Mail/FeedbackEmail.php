<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $contato;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\App\Contato $contato)
    {
        $this->contato = $contato;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'freire.joe@gmail.com'), env('MAIL_FROM_NAME','Teste Prolife'))
            ->subject('Confirmacao de contato')
            ->markdown('emails.feedback')
            ->with([
                'nome'       => $this->contato->nome,
                'email'      => $this->contato->email,
                'telefone'   => $this->contato->telefone,
                'mensagem'   => $this->contato->mensagem,
                'ip_origem'  => $this->contato->ip_origem,
                'created_at' => $this->contato->created_at,
            ]);
    }
}
