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
            ->line('Bonjour,')
            ->line('Une nouvelle demande a été soumise et nécessite votre attention. Voici les détails :')
            ->line('- Employe : ' .$this->demande->employe->nom.' '.$this->demande->employe->prenom)
            ->line('- Type de demande : ' . $this->demande->type_de_demande)
            ->line('- Motif : ' . $this->demande->motif)
            ->line('- Date de soumission : ' . $this->demande->created_at->format('d/m/Y H:i'))
            ->line('Merci de traiter cette demande dans les meilleurs délais.')
            ->line('Cordialement,')
            ->line('L\'équipe e-SICA');
    }
}