<?php

namespace App\Notifications;

use App\Models\Signalement;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NouveauSignalementNotification extends Notification
{
    use Queueable;
    public $signalement;

    /**
     * Create a new notification instance.
     */
    public function __construct(Signalement $signalement)
    {
        $this->signalement = $signalement;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        // return [
        //     'message' => 'Vous avez reçu un nouveau signalement de la part du résident ' . $this->signalement->resident->nom,
        //     'signalement_id' => $this->signalement->id,
        // ];
        return [
            'message' => 'Vous avez reçu un nouveau signalement de la part de ' . $this->signalement->resident->prenom_resident . ' ' . $this->signalement->resident->nom_resident,
            'signalement_id' => $this->signalement->id,
            'resident_nom' => $this->signalement->resident->prenom_resident,
            'resident_prenom' => $this->signalement->resident->nom_resident,
        ];
    }
}
