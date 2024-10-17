<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // public function markAsRead($id)
    // {
    //     $notification = Auth::guard('mairie')->user()->unreadNotifications->find($id);// ajout de guards ici
    
    //     if ($notification) {
    //         $notification->markAsRead();
    //     }
    
    //     return redirect()->route('mairie.signalements.show', $notification->data['signalement_id']);
    // }
    public function markAsRead($id)
    {
        // Vérifier si l'utilisateur est une mairie
        if (Auth::guard('mairie')->check()) {
            $notification = Auth::guard('mairie')->user()->unreadNotifications->find($id);
            
            if ($notification) {
                $notification->markAsRead();
            }

            // Redirection après avoir marqué comme lu
            return redirect()->route('mairie.signalements.show', $notification->data['signalement_id']);
        }

        // Vérifier si l'utilisateur est un résident
        elseif (Auth::guard('resident')->check()) {
            $notification = Auth::guard('resident')->user()->unreadNotifications->find($id);

            if ($notification) {
                $notification->markAsRead();
            }

            // Redirection vers la page des tâches pour le résident
            return redirect()->route('signalements.index', $notification->data['tache_collecte_id']);
        }

        // Si aucun utilisateur n'est authentifié
        return redirect()->back()->with('error', 'Aucun utilisateur authentifié.');
    }
    
}
