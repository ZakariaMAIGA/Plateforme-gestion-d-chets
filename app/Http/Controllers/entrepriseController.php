<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\Resident;
use App\Models\ServiceRecyclage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class entrepriseController extends Controller
{
    public function entre_annuaire(){


        $compteId = Auth::guard('entreprise')->id();

        // Récupérer la mairie associée au compte
        $entreprise = Entreprise::where('compte_id', $compteId)->first();

        // Récupérer tous les signalements pour cette mairie
        $servicesCount = ServiceRecyclage::where('entreprise_id', $entreprise->id)->count();
        $residentsCount = Resident::count();

        return view('entreprise.annuaire', compact('servicesCount', 'residentsCount',));
    }


}
