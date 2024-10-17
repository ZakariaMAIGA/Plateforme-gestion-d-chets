<?php

namespace App\Http\Controllers;

use App\Models\Mairie;
use App\Models\Resident;
use App\Models\Signalement;
use App\Notifications\NouveauSignalementNotification;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class signalementController extends Controller
{

    public function create()
    {
        // Récupère toutes les mairies pour remplir le formulaire
        $mairies = Mairie::all();
        return view('signalement.create', compact('mairies'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        // Valide les données du formulaire
        $request->validate([
            'type_probleme' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'required|image|max:2048',
            'mairie_id' => 'required|exists:mairies,id',
            'date_signalement'=>'required|date',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);

        // Gère l'upload de la photo
         
    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $imageName = time().'_'.$image->getClientOriginalName();
        $imagePath = $image->storeAs('images/signalements', $imageName, 'public');
    }

        // Crée le signalement avec le statut "En cours"
        // Récupère le compte authentifié
         $compte = Auth::guard('resident')->user();
        // Récupère le résident associé à ce compte
        $resident = $compte->resident;
    
                $signalement = Signalement::create([
                    'type_probleme' => $request->type_probleme,
                    'description' => $request->description,
                    'photo' => $imagePath,
                    'date_signalement' => $request->date_signalement, //test de noty
                    //'statut' => 'en_cours',
                    'statut' => 'en_attente',
                    'latitude'=>$request->latitude,
                    'longitude'=> $request->longitude,
                    'resident_id' => $resident->id,
                    'mairie_id' => $request->mairie_id,
                   
        ]);
      // dd($signalement);
        // Envoyer la notification à la mairie
        $mairie = Mairie::find($request->mairie_id);
        $mairie->compte->notify(new NouveauSignalementNotification($signalement));
        
            

        return redirect()->route('signalements.index')->with('status', 'Signalement créé avec succès.');
    }

    public function index()
    {
        // Récupère tous les signalements pour le résident connecté
        $compteId = Auth::guard('resident')->id();
        $resident = Resident::where('compte_id', $compteId)->first();
        $signalements = Signalement::where('mairie_id', $resident->id)->get();
       
        //$signalements = Signalement::where('resident_id', Auth::guard('resident')->id())->get();
       
        return view('signalement.liste', compact('signalements'));
    }



    //pour voir le signalement specifique
    public function show(Signalement $signalement)
{
    // Vérifie que le signalement appartient au résident connecté
    // if ($signalement->resident_id !=Auth::guard('resident')->id()) { j'ai commente ici pour tester
    //     abort(403, 'Accès non autorisé');
    // }
         
        $compteId = Auth::guard('resident')->id();

         $resident = Resident::where('compte_id', $compteId)->first();
         // dd($signalement->resident_id);
          if ($signalement->resident_id != $resident->id) {
           abort(403, 'Accès non autorisé');

    }

    return view('signalement.show', compact('signalement'));
}


//Mise a jour du signalement

public function edit(Signalement $signalement)
{
    // Vérifie que le signalement appartient au résident connecté
    // if ($signalement->resident_id != Auth::guard('resident')->id()) {
    //     abort(403, 'Accès non autorisé');
    // }

    $compteId = Auth::guard('resident')->id();
        
    $resident = Resident::where('compte_id', $compteId)->first();

     if ($signalement->resident_id != $resident->id) {
      abort(403, 'Accès non autorisé');

}

    // Vérifie que le signalement est toujours "en cours"
    if ($signalement->statut != 'en_attente') {
        return redirect()->route('signalements.index')->with('error', 'Vous ne pouvez plus éditer ce signalement.');
    }

    // Récupère toutes les mairies pour remplir le formulaire
    $mairies = Mairie::all();

    return view('signalement.update', compact('signalement', 'mairies'));
}

public function update(Request $request, Signalement $signalement)
{
    // Vérifie que le signalement appartient au résident connecté
    // 
    
    $compteId = Auth::guard('resident')->id();
        
     $resident = Resident::where('compte_id', $compteId)->first();

    if ($signalement->resident_id != $resident->id) {
        abort(403, 'Accès non autorisé');

    }


    // Vérifie que le signalement est toujours "en cours"
    if ($signalement->statut != 'en_cours') {
        return redirect()->route('signalements.index')->with('error', 'Vous ne pouvez plus éditer ce signalement.');
    }

    // Valide les données du formulaire
    $request->validate([
        'type_probleme' => 'required|string|max:255',
        'description' => 'required|string',
        'photo' => 'nullable|image|max:2048',
        'mairie_id' => 'required|exists:mairies,id',
        'date_signalement' => 'required|date',
    ]);

    // Gère l'upload de la nouvelle photo, si une nouvelle photo est fournie
    if ($request->hasFile('photo')) {
        $image = $request->file('photo');
        $imageName = time().'_'.$image->getClientOriginalName();
        $imagePath = $image->storeAs('images/signalements', $imageName, 'public');
        // Supprime l'ancienne image si elle existe
        if ($signalement->photo) {
            Storage::disk('public')->delete($signalement->photo);
        }
        // Met à jour le chemin de la nouvelle image
        $signalement->photo = $imagePath;
    } else {
        // Si aucune nouvelle photo n'est téléchargée, conserver l'ancienne
        $imagePath = $signalement->photo;
    }

    // Met à jour le signalement avec les nouvelles données
    $signalement->update([
        'type_probleme' => $request->type_probleme,
        'description' => $request->description,
        'photo' => $imagePath,
        'mairie_id' => $request->mairie_id,
        'date_signalement' => $request->date_signalement,
    ]);

    return redirect()->route('signalements.index')->with('status', 'Signalement mis à jour avec succès.');
}

//Suppression du signalement

public function destroy(Signalement $signalement)
{
    // Vérifie que le signalement appartient au résident connecté
    // if ($signalement->resident_id != Auth::guard('resident')->id()) {
    //     abort(403, 'Accès non autorisé');
    // }

    $compteId = Auth::guard('resident')->id();
        
    $resident = Resident::where('compte_id', $compteId)->first();

    if ($signalement->resident_id != $resident->id) {
        abort(403, 'Accès non autorisé');

    }


    // Vérifie que le signalement est toujours "en cours"
    if ($signalement->statut != 'en_attente') {
        return redirect()->route('signalements.index')->with('error', 'Vous ne pouvez plus supprimer ce signalement.');
    }

    // Supprime l'image associée au signalement, si elle existe
    if ($signalement->photo) {
        Storage::disk('public')->delete($signalement->photo);
    }

    // Supprime le signalement par le resident connecte
    $signalement->delete();

    return redirect()->route('signalements.index')->with('status', 'Signalement supprimé avec succès.');
}


//La gestion du signalement par la mairie

// Affiche tous les signalements pour la mairie connectée
public function indexForMairie()
{
    // Récupérer l'ID du compte de la mairie actuellement connectée
    $compteId = Auth::guard('mairie')->id();
    // Trouver l'ID de la mairie associée à ce compte
    $mairie = Mairie::where('compte_id', $compteId)->first();

    // Récupérer les signalements pour cette mairie
    $signalements = Signalement::where('mairie_id', $mairie->id)->get();

    // Récupérer les notifications non lues
    $notifications = $mairie->compte->unreadNotifications;
    
    return view('signalement.indexmairie', compact('signalements', 'notifications'));
    
    
}

// Affiche un signalement spécifique pour la mairie
public function showForMairie(Signalement $signalement)
{
       // Récupérer l'ID du compte de la mairie actuellement connectée
         $compteId = Auth::guard('mairie')->id();
    
       // Trouver l'ID de la mairie associée à ce compte
        $mairie = Mairie::where('compte_id', $compteId)->first();

         // Vérifie que le signalement appartient bien à la mairie connectée
         if ($signalement->mairie_id != $mairie->id) {
          abort(403, 'Accès non autorisé');
   }
   return view('signalement.showmairie', compact('signalement'));

}

// Change le statut d'un signalement
public function changeStatus(Request $request, Signalement $signalement)
{
   
   $compteId = Auth::guard('mairie')->id();
    
  
    $mairie = Mairie::where('compte_id', $compteId)->first();

     if ($signalement->mairie_id != $mairie->id) {
      abort(403, 'Accès non autorisé');
}

    // Valide le nouveau statut
    $request->validate([
        'statut' => 'required|string|in:en_attente,en_cours,traite',
    ]);

    // Met à jour le statut du signalement
    $signalement->update([
        'statut' => $request->statut,
    ]);

    return redirect()->route('mairie.signalements.index')->with('status', 'Statut du signalement mis à jour avec succès.');
}



// Supprime un signalement pour la mairie
public function destroyForMairie(Signalement $signalement)
{
    // Récupérer l'ID du compte de la mairie actuellement connectée
    $compteId = Auth::guard('mairie')->id();
    
    // Trouver l'ID de la mairie associée à ce compte
    $mairie = Mairie::where('compte_id', $compteId)->first();

    // Vérifie que le signalement appartient bien à la mairie connectée
    if ($signalement->mairie_id != $mairie->id) {
        abort(403, 'Accès non autorisé');
    }

    // Supprimer le signalement
    $signalement->delete();

    return redirect()->route('mairie.signalements.index')->with('status', 'Signalement supprimé avec succès.');
}


}
