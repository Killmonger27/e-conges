<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmployeCreeNotification extends Notification
{
    use Queueable;

    protected $employe;

    public function __construct($employe)
    {
        $this->employe = $employe;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Creation de votre compte sur e-SICA')
            ->line('Votre compte a été créé avec succès.')
            ->line('Nom : '.$this->employe->nom.' '.$this->employe->prenom)
            ->line('Email : '.$this->employe->email)
            ->line('Mot de passe par defaut: 12345678')
            ->line('Veuillez vous connecter à l\'application pour accéder à vos informations et modifier votre mot de passe.')
            ->line('Si vous n\'avez pas demandé de créer un compte, veuillez ignorer cet email.')
            ->line('Merci de votre compréhension.')
            ->line('Cordialement,')
            ->line('L\'équipe e-SICA IBAM');
    }
}
