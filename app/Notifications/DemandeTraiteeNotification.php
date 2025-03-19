<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeTraiteeNotification extends Notification
{
    use Queueable;

    protected $demande;
    protected $statut;

    public function __construct($demande, $statut)
    {
        $this->demande = $demande;
        $this->statut = $statut;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
{
    $message = (new MailMessage)
        ->subject('Traitement de votre demande')
        ->line('Bonjour '.$this->demande->employe->nom.',')
        ->line('Nous vous informons que votre demande du '.$this->demande->date_de_demande.' a été traitée. Voici les détails :')
        ->line('- Type de demande : '.$this->demande->type_de_demande)
        ->line('- Motif : '.$this->demande->motif)
        ->line('- Statut : '.$this->statut);

    if ($this->statut === 'approuvee') {
        $message->line('Décision : Votre demande a été approuvée. Vous pouvez maintenant etablir votre planning en conséquence.');
    } elseif ($this->statut === 'rejete') {
        $message->line('Décision : Votre demande a été rejetée. Pour plus d\'informations, veuillez contacter votre responsable.');
    }

    $message->action('Voir les détails de la demande', url('/demandes/'.$this->demande->id))
            ->line('Nous vous remercions de votre confiance et restons à votre disposition pour toute information complémentaire.')
            ->line('Cordialement,')
            ->line('L\'équipe e-SICA IBAM');

    return $message;
}
}
