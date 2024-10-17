<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Equipe;
use App\Models\Mairie;
use App\Models\ServiceRecyclage;
use App\Models\Signalement;
use App\Models\TacheCollecte;
use Illuminate\Http\Request;

class homeController extends Controller
{
     public function index(){

         // Récupérer le nombre de comptes
    $nombreComptes = Compte::count();

    // Récupérer le nombre de services de recyclage
    $nombreServices = ServiceRecyclage::count();

    // Récupérer le nombre de signalements
    $nombreSignalements = Signalement::count();

    // Récupérer le nombre de tâches
    $nombreTaches = TacheCollecte::count();
    $nombreSignalementsEnCours = Signalement::where('statut', 'en_cours')->count();
    $nombreSignalementsEnAttente = Signalement::where('statut', 'en_attente')->count();
    $nombreSignalementsTraites = Signalement::where('statut', 'traite')->count();
    $nombreEquipe=Equipe::count();
    $meilleureMairie = Mairie::withCount('signalements') // Compter les signalements liés à chaque mairie
        ->orderBy('signalements_count', 'desc') // Trier par le nombre de signalements
        ->first(); // Récupérer la première mairie

    // Vérifier s'il existe une mairie avec des signalements
    $nomMeilleureMairie = $meilleureMairie ? $meilleureMairie->nom_mairie : 'Aucune mairie';


    // Passer les données à la vue
    return view('layouts.index', compact('nombreComptes', 'nombreServices', 'nombreSignalements',
     'nombreTaches', 'nombreSignalementsEnCours', 
    'nombreSignalementsEnAttente', 'nombreSignalementsTraites', 'nombreEquipe', 'nomMeilleureMairie',));
         //return view('layouts.index'); //Je vais faire un avec la methode index()que je vais la definir dans l'authController pour pouvoir me rediriger vers la page d'index apres avoir se connecter
    }

    //juste un test

    // public function test(){
    //     return view('users.ajouter');
    // }
}
