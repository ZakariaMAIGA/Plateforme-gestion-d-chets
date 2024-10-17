<?php

namespace App\Http\Controllers;

use App\Models\ServiceRecyclage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class serviceController extends Controller
{

    public function index()
    {
        $services = ServiceRecyclage::with('entreprise')->get();
        return view('services.liste', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }


    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'description' => 'required|string|max:255',
            'type_materiau' => 'required|string|max:255',
            'methode_collecte' => 'required|string|max:255',
        ]);

        // Récupérer l'utilisateur connecté et son entreprise
        $compte = Auth::guard('entreprise')->user();
        $entreprise = $compte->entreprise;
        //dd($entreprise);

        // Créer un nouveau service
        ServiceRecyclage::create([
            'description' => $request->description,
            'type_materiau' => $request->type_materiau,
            'methode_collecte' => $request->methode_collecte,
            'entreprise_id' => $entreprise->id,
        ]);

        return redirect()->route('services.index')->with('success', 'Service de recyclage proposé avec succès.');
    }


    public function edit($id)
{
    // Trouver le service par son ID
    $service = ServiceRecyclage::findOrFail($id);

    // Vérifier si l'utilisateur connecté est bien le propriétaire de ce service
    if (Auth::guard('entreprise')->user()->entreprise->id !== $service->entreprise_id) {
        return redirect()->route('services.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce service.');
    }

    // Retourner la vue avec le service à éditer
    return view('services.edit', compact('service'));
}


public function update(Request $request, $id)
{
    // Valider les nouvelles données du formulaire
    $request->validate([
        'description' => 'required|string|max:255',
        'type_materiau' => 'required|string|max:255',
        'methode_collecte' => 'required|string|max:255',
    ]);

    // Trouver le service à mettre à jour
    $service = ServiceRecyclage::findOrFail($id);

    // Vérifier si l'utilisateur connecté est bien le propriétaire de ce service
    if (Auth::guard('entreprise')->user()->entreprise->id !== $service->entreprise_id) {
        return redirect()->route('services.index')->with('error', 'Vous n\'êtes pas autorisé à modifier ce service.');
    }

    // Mettre à jour le service avec les nouvelles données
    $service->update([
        'description' => $request->description,
        'type_materiau' => $request->type_materiau,
        'methode_collecte' => $request->methode_collecte,
    ]);

    return redirect()->route('services.index')->with('success', 'Service de recyclage mis à jour avec succès.');
}

public function destroy($id)
{
    // Trouver le service à supprimer
    $service = ServiceRecyclage::findOrFail($id);

    // Vérifier si l'utilisateur connecté est bien le propriétaire de ce service
    if (Auth::guard('entreprise')->user()->entreprise->id !== $service->entreprise_id) {
        return redirect()->route('services.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer ce service.');
    }

    // Supprimer le service
    $service->delete();

    return redirect()->route('services.index')->with('success', 'Service de recyclage supprimé avec succès.');
}


}
