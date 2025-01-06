<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Mairie;
use App\Models\Signalement;
use App\Models\TacheCollecte;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class autoriteController extends Controller
{
    public function dash_autorite(){




        // Récupérer l'ID du compte de la mairie connectée
        $compteId = Auth::guard('mairie')->id();

        // Récupérer la mairie associée au compte
        $mairie = Mairie::where('compte_id', $compteId)->first();

        // Récupérer tous les signalements pour cette mairie
        $signalementsCount = Signalement::where('mairie_id', $mairie->id)->count();
        $equipesIds = Equipe::where('mairie_id', $mairie->id)->pluck('id');
        $nombreTachesAttribuees = TacheCollecte::whereIn('equipe_id', $equipesIds)->count();

         $equipesCount=Equipe::where('mairie_id', $mairie->id)->count();
        // Envoyer le nombre de signalements à la vue du tableau de bord
        


        $compteId = Auth::guard('mairie')->id();

        // Récupérer la mairie associée au compte
        $mairie = Mairie::where('compte_id', $compteId)->first();
       // dd($mairie);
    
        // Récupérer le nombre total de signalements pour cette mairie
        $nombreTotalSignalements = Signalement::where('mairie_id', $mairie->id)->count();
    
        // Récupérer le nombre de signalements traités pour cette mairie
        $nombreSignalementsTraites = Signalement::where('mairie_id', $mairie->id)
                                                 ->where('statut', 'traite') // ou 'géré', selon la terminologie de ta base de données
                                                 ->count();
    
        // Calculer la productivité en évitant la division par zéro
        $productivite = $nombreTotalSignalements > 0 
                        ? ($nombreSignalementsTraites / $nombreTotalSignalements) * 100 
                        : 0;
    

      $nombreResidentsAvecSignalements = Signalement::where('mairie_id', $mairie->id)
                                                  ->distinct('resident_id') // On utilise distinct pour compter les résidents uniques
                                                  ->count('resident_id'); // Compter le nombre de résidents uniqu

     $signalementsParMois = Signalement::selectRaw('MONTH(created_at) as mois, COUNT(*) as total')
                                      ->where('mairie_id', $mairie->id)
                                      ->whereYear('created_at', Carbon::now()->year)
                                      ->where('statut', 'traite') // Filtrer par signalements gérés
                                      ->groupByRaw('MONTH(created_at)')
                                      ->get();


 

    // Supposons que tu utilises Eloquent pour récupérer les données des signalements par mois
    // Exemple : récupérer le nombre de signalements par mois
   $signalements = Signalement::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
    ->where('mairie_id', $mairie->id) // Filtrer par l'ID de la mairie
    ->whereYear('created_at', Carbon::now()->year) // Filtrer par année
    ->groupBy('month')
    ->orderBy('month')
    ->get();

// Initialise un tableau avec 12 mois
$signalementsData = array_fill(1, 12, 0);

// Remplir les données avec les résultats de la requête
foreach ($signalements as $signalement) {
    $signalementsData[$signalement->month] = $signalement->count;
}

// dd pour vérifier les données
//dd($signalementsData);

        // Passer les données à la vue
        return view('autorite.dashAutorite', compact('productivite', 'nombreTotalSignalements', 
        'nombreSignalementsTraites',
         'nombreTachesAttribuees', 'equipesCount',
          'nombreResidentsAvecSignalements',
          'signalementsParMois',
          'signalementsData',
        ));
    }



}
