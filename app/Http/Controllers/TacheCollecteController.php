<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Mairie;
use App\Models\Resident;
use App\Models\Signalement;
use App\Models\TacheCollecte;
use App\Notifications\SignalementTraiteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TacheCollecteController extends Controller
{
    
    

    public function create($signalementId)
    {
        // Récupérer le dernier ID de la tâche de collecte et l'incrémenter
        $lastTacheId = TacheCollecte::latest('id')->first()?->id ?? 0;
        $nextTacheId = $lastTacheId + 1;
    
        // Récupérer la mairie actuellement connectée
        $compte = Auth::guard('mairie')->user(); // Assurez-vous que 'mairie' est le bon guard pour la mairie
        $mairie = $compte->mairie; // On suppose que le compte est lié à la mairie
    
        // Filtrer les équipes associées à la mairie connectée
        $equipes = Equipe::where('mairie_id', $mairie->id)->get();
    
        // Récupérer le signalement pour lequel on veut créer une tâche
        $signalement = Signalement::findOrFail($signalementId);
    
        return view('tacheCollectes.create', compact('nextTacheId', 'equipes', 'signalement'));
    }
    

    public function store(Request $request)
{
    // Valider les données du formulaire
    $request->validate([
        'equipe_id' => 'required|exists:equipes,id',
        'signalement_id' => 'required|exists:signalements,id',
        'date_collecte' => 'required|date',
        'heure_collecte' => 'required',
    ]);

    // Créer une nouvelle tâche de collecte
    $tacheCollecte = TacheCollecte::create([
        'equipe_id' => $request->equipe_id,
        'date_attribution' => now(),
        'statut' => 'traite', // Le statut passe à traité une fois créé
    ]);

    // Associer le signalement à la tâche dans la table pivot
    $tacheCollecte->signalements()->attach($request->signalement_id, [
        'date_collecte' => $request->date_collecte,
        'heure_collecte' => $request->heure_collecte,
    ]);

    // Mettre à jour le statut du signalement à "traite"
    $signalement = Signalement::findOrFail($request->signalement_id);
    $signalement->statut = 'traite';
    $signalement->save();
    // Envoie une notification au résident
    $resident = $signalement->resident;
    $signalement->resident->compte->notify(new SignalementTraiteNotification($tacheCollecte, $signalement));

    return redirect()->route('tache.index')->with('status', 'Tâche attribuée et signalement traité avec succès.');
}


public function index()
{
    // Récupérer la mairie actuellement connectée
    $mairie = Auth::guard('mairie')->user()->mairie;

    // Récupérer toutes les équipes associées à cette mairie
    $equipesMairie = $mairie->equipe()->pluck('id');

     
    $tachesCollectes = TacheCollecte::with(['equipe', 'signalements'])
    ->whereIn('equipe_id', $equipesMairie) // Filtrer les tâches par les équipes de la mairie connectée
    ->get()
    ->map(function ($tache) {
        // Vérifier si la tâche a des signalements associés
        $signalement = $tache->signalements->first();
        if (!$signalement) {
            return null;
        }

        // Vérifier si le pivot existe
        $pivot = $signalement->pivot ?? null;
        if (!$pivot) {
            return null;
        }

        return (object) [
            'id' => $tache->id,  // Inclure l'ID de la tâche
            'nom_equipe' => $tache->equipe->nom ?? 'N/A', // Nom de l'équipe ou "N/A"
            'date_collecte' => $pivot->date_collecte, // Date de collecte
            'heure_collecte' => $pivot->heure_collecte, // Heure de collecte
            'date_attribution' => $tache->date_attribution, // Date d'attribution
            'statut' => $tache->statut, // Statut de la tâche
            'type_probleme' => $signalement->type_probleme, // Type de problème
        ];
    })
    ->filter(); // Filtrer les tâches nulles ou non valides
    $nombreTachesAttribuees = $tachesCollectes->count();


    // Passer les tâches à la vue
    return view('tacheCollectes.liste', compact('tachesCollectes', 'nombreTachesAttribuees' ));
}


public function edit($id)
{
    // Récupérer la tâche de collecte
    $tache = TacheCollecte::findOrFail($id);

    // Récupérer la mairie actuellement connectée
    $compte = Auth::guard('mairie')->user();
    $mairie = $compte->mairie;

    // Filtrer les équipes associées à la mairie connectée
    $equipes = Equipe::where('mairie_id', $mairie->id)->get();

    // Récupérer le signalement associé à cette tâche
    $signalement = $tache->signalements->first(); // on suppose qu'il y a une relation

    return view('tacheCollectes.update', compact('tache', 'equipes', 'signalement'));
}


public function update(Request $request, $id)
{
    // Valider les données du formulaire
    $request->validate([
        'equipe_id' => 'required|exists:equipes,id',
        'date_collecte' => 'required|date',
        'heure_collecte' => 'required',
    ]);

    // Trouver la tâche de collecte à mettre à jour
    $tache = TacheCollecte::findOrFail($id);

    // Mettre à jour les champs
    $tache->update([
        'equipe_id' => $request->equipe_id,
        'statut' => 'traite',
    ]);

    // Mettre à jour la table pivot pour le signalement associé
    $tache->signalements()->updateExistingPivot($request->signalement_id, [
        'date_collecte' => $request->date_collecte,
        'heure_collecte' => $request->heure_collecte,
    ]);

    return redirect()->route('tache.index')->with('status', 'Tâche mise à jour avec succès.');
}

public function destroy($id)
{
    // Trouver la tâche de collecte à supprimer
    $tache = TacheCollecte::findOrFail($id);

    // Supprimer la tâche et les associations avec les signalements
    $tache->signalements()->detach();
    $tache->delete();

    return redirect()->route('tache.index')->with('status', 'Tâche supprimée avec succès.');
}


public function show($id)
{
    // Récupérer la tâche de collecte par son ID avec ses relations
    $tache = TacheCollecte::with(['equipe', 'signalements'])
                    ->findOrFail($id); // Retourne une erreur 404 si la tâche n'existe pas

    // Récupérer l'ID du compte de la mairie actuellement connectée
    $compteId = Auth::guard('mairie')->id();
                        
    // Trouver l'ID de la mairie associée à ce compte
    $mairie = Mairie::where('compte_id', $compteId)->first();
                    
    //Vérifie que la tache appartient bien à la mairie connectée
                 
    if ($tache->equipe->mairie_id != $mairie->id) {
              abort(403, 'Accès non autorisé');
         }
    return view('tacheCollectes.show', compact('tache'));
}





}
  