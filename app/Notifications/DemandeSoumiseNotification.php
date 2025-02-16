<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeSoumiseNotification extends Notification
{
    use Queueable;

    protected $demande;

    public function __construct($demande)
    {
        $this->demande = $demande;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle demande soumise')
            ->line('Une nouvelle demande a été soumise.')
            ->line('Type de demande : '.$this->demande->type_de_demande)
            ->line('Motif : '.$this->demande->motif)
            ->action('Voir les détails de la demande', url('/demandes/'.$this->demande->id));
    }
}
