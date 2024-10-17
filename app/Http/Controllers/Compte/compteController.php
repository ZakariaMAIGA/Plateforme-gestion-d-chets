<?php

namespace App\Http\Controllers\Compte;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Compte;
use App\Models\Entreprise;
use App\Models\Mairie;
use App\Models\Resident;
use App\Models\TypeCompte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class compteController extends Controller
{


    public function create()
{
     
    $type_comptes = TypeCompte::all();
    
    return view('comptes.ajouter', compact('type_comptes'));
}

public function store(Request $request)
    {
       //dd($request->all());
        // Validation des données communes
        $request->validate([
            'nom_user' => 'required|string|max:255',
            'email' => 'required|email|unique:comptes,email',
            'password' => 'required|string|min:8',
            'phone' => 'required|string|max:20',
            'adresse' => 'required|string|max:255',
            'type_compte' => 'required|exists:type_comptes,id',
           //'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        if ($request->hasFile('avatar')) {
            // Récupérer le fichier image
            $image = $request->file('avatar');
            // Générer un nom unique pour l'image
            $imageName = time().'_'.$image->getClientOriginalName();
            // Stocker l'image dans le répertoire 'public/images/avatars'
            $imagePath = $image->storeAs('images/avatars', $imageName, 'public');
        }  
      // dd($request->file('avatar'));
       //dd($imagePath);
        // Création du compte principal
        $compte = Compte::create([
            'nom_user' => $request->nom_user,
            'email' => $request->email,
            //'password' => $request->password,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'type_compte_id' => $request->type_compte,
            'avatar' => $imagePath,//nouvel ajout
        ]);
      //dd($compte);
        
       

        // Logique spécifique en fonction du type de compte
        switch ($request->type_compte) {
            case 1: // Resident
                $request->validate([
                    'nom_resident' => 'required|string|max:255',
                    'prenom_resident' => 'required|string|max:255',
                    'adresse' => 'required|string|max:255',
                ]);
                Resident::create([
                    'compte_id' => $compte->id,
                    'nom_resident' => $request->nom_resident,
                    'prenom_resident' => $request->prenom_resident,
                    'adresse'=> $request->adresse,
                    
                ]);
                break;

            case 2: // Mairie
                $request->validate([
                    'nom_mairie' => 'required|string|max:255',
                    'commune' => 'required|string|max:255',
                    'region' => 'required|string|max:255',
                ]);
                Mairie::create([
                    'compte_id' => $compte->id,
                    'nom_mairie' => $request->nom_mairie,
                    'commune' => $request->commune,
                    'region' => $request->region,
                ]);
                break;

            case 3: // Entreprise
                $request->validate([
                    'nom_entreprise' => 'required|string|max:255',
                    'service' => 'required|string|max:255',
                    'adresse' => 'required|string|max:255',
                ]);
                Entreprise::create([
                    'compte_id' => $compte->id,
                    'nom_entreprise' => $request->nom_entreprise,
                    'service' => $request->service,
                    'adresse' => $request->adresse,
                ]);
                break;

            case 4: // Admin
                $request->validate([
                    'nom' => 'required|string|max:255',
                    'prenom' => 'required|string|max:255',
                    'adresse' => 'required|string|max:255',
                ]);
                Admin::create([
                    'compte_id' => $compte->id,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'adresse'=> $request->adresse,
                ]);
                break;

            default:
                return redirect()->back()->withErrors(['type_compte' => 'Type de compte invalide.']);
        }

        // Redirection avec succès
        return redirect()->route('comptes.index')->with('status', 'Compte créé avec succès.');
    }


   //Fin de creation de compte



    public function index()
{
    // Récupérer les comptes avec les relations
    $comptes = Compte::with(['resident', 'mairie', 'entreprise'])->get();

    return view('comptes.liste', compact('comptes'));
}


// Afficher le formulaire d'édition
public function edit($id)
{
    $compte = Compte::with(['resident', 'mairie', 'entreprise', 'admin'])->findOrFail($id);
  // return view('comptes.edit', compact('compte'));
  $type_comptes = TypeCompte::all();   //Je vais faire une recherche la dessus
      return view('comptes.edit', compact('compte', 'type_comptes'));  // Mise à jour du type de compte
}

// Mettre à jour les informations de l'utilisateur
public function update(Request $request, $id)
{
    $compte = Compte::findOrFail($id);
    $compte->update($request->only('nom_user', 'email', 'phone', 'adresse'));
    
    if ($compte->resident) {
        $compte->resident->update($request->only('nom_resident', 'prenom_resident'));
    } elseif ($compte->mairie) {
        $compte->mairie->update($request->only('nom_mairie'));
    } elseif ($compte->entreprise) {
        $compte->entreprise->update($request->only('nom_entreprise'));
    }elseif ($compte->admin) {
        $compte->admin->update($request->only('nom'));
    }
    // Mise à jour du type de compte
    $compte->typecompte()->associate($request->input('type_compte'));
    $compte->save();

    return redirect()->route('comptes.index')->with('status', 'Utilisateur mis à jour avec succès');
}

// Supprimer un utilisateur
public function destroy($id)
{
    $compte = Compte::findOrFail($id);
    
    if ($compte->resident) {
        $compte->resident->delete();
    } elseif ($compte->mairie) {
        $compte->mairie->delete();
    } elseif ($compte->entreprise) {
        $compte->entreprise->delete();
    }
    elseif ($compte->admin) {
        $compte->admin->delete();
    }
    
    $compte->delete();

    return redirect()->route('comptes.index')->with('status', 'Utilisateur supprimé avec succès');
}

//Deconnexion pour les tous types de comptes
public function logout(Request $request)
    {
        // Récupérer le guard en fonction de l'utilisateur connecté
        if (Auth::guard('resident')->check()) {
            Auth::guard('resident')->logout();
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } elseif (Auth::guard('mairie')->check()) {
            Auth::guard('mairie')->logout();
        } elseif (Auth::guard('entreprise')->check()) {
            Auth::guard('entreprise')->logout();
        }

        // Invalider la session
        $request->session()->invalidate();

        // Régénérer le token CSRF
        $request->session()->regenerateToken();

        // Rediriger vers la page de connexion ou la page d'accueil
        return redirect('/');
    }


//Pour la validation du type de compte mairie et entreprise
   public function validateCompte($id)
{
    $compte = Compte::find($id);

    if ($compte && ($compte->type_compte_id == 2 || $compte->type_compte_id == 3)) {
        $compte->is_validated = true;
        $compte->save();

        return redirect()->route('comptes.index')->with('status', 'Compte validé avec succès.');
    }

    return redirect()->route('comptes.index')->with('error', 'Échec de la validation du compte.');
}


}
