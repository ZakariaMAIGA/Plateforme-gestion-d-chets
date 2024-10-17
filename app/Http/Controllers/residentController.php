<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\Signalement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class residentController extends Controller
{
    public function dash_resident(){
        
        
        $compteId = Auth::guard('resident')->id();

        // Récupérer la mairie associée au compte
        $resident = Resident::where('compte_id', $compteId)->first();

        // Récupérer tous les signalements pour cette mairie
        $signalementsCount = Signalement::where('resident_id', $resident->id)->count();

        $nombreSignalementsCours = Signalement::where('resident_id', $resident->id)
        ->where('statut', 'en_cours') // ou 'géré', selon la terminologie de ta base de données
        ->count();
        $nombreSignalementsAttente = Signalement::where('resident_id', $resident->id)
        ->where('statut', 'en_attente') // ou 'géré', selon la terminologie de ta base de données
        ->count();
        $nombreSignalementsTraite = Signalement::where('resident_id', $resident->id)
        ->where('statut', 'traite') // ou 'géré', selon la terminologie de ta base de données
        ->count();



        return view('resident.residentDash', compact('signalementsCount', 'nombreSignalementsCours','nombreSignalementsAttente','nombreSignalementsTraite'));
    }

 
    
}
