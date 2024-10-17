<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SignalementTraiteNotification extends Notification
{
    use Queueable;
    protected $tacheCollecte;
    protected $signalement;


    /**
     * Create a new notification instance.
     */
    public function __construct($tacheCollecte, $signalement)
    {
        $this->tacheCollecte = $tacheCollecte;
        $this->signalement = $signalement;
        // Récupérer les informations du pivot entre Signalement et TacheCollecte
   // $pivot = $signalement->tachecollectes()->where('tache_collecte_id', $tacheCollecte->id)->first()->pivot;

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

    public function toArray(object $notifiable): array
{
    // Récupérer les informations de la tâche de collecte et du pivot
    $signalement = $this->signalement; 
    $tacheCollecte = $this->tacheCollecte;
    

    // Récupérer les informations du pivot entre Signalement et TacheCollecte
    $pivot = $signalement->tacheCollectes()->where('tache_collecte_id', $tacheCollecte->id)->first()->pivot;
     // Convertir la date en objet Carbon et formater
     $dateCollecte = Carbon::parse($pivot->date_collecte)->format('d/m/y');
    
     return [
         'message' => 'Votre signalement a été traité. Une équipe sera déployée pour collecter les déchets le ' . $dateCollecte . ' à ' . $pivot->heure_collecte. '.'. 'Merci pour votre confiance !',
         'tache_collecte_id' => $tacheCollecte->id,
         'date_collecte' => $dateCollecte,
         'heure_collecte' => $pivot->heure_collecte,
     ];
}

     
}
