<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use App\Models\Entreprise;
use App\Models\Mairie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EntrepriseAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.Entreprise_register');
    }

    public function register(Request $request)
    {   
        $request->validate([
            'nom_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:comptes',
            'password' => 'required|string|min:8',
            //'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|min:8',
            'nom_entreprise' => 'required|string|max:255',
            'service' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ], 
        [
            'nom_user.required' => 'Le nom utilisateur est requis.',
            'email.required' => 'L\'email doit etre requis.',
            'password.required' => 'Le mot de passe est requis et max 8 chiffres.',
            'phone.required' => 'Le numero est obligatoire.',
            'adresse.required' => 'L\'adresse est requis.',
            'nom_entreprise.required' => 'Le nom est requis.',
            'service.required' => 'La commune est requise.',
            //'region.required'=>'La region est requise',
        ]);
        
    


        if ($request->hasFile('avatar')) {
            // Récupérer le fichier image
            $image = $request->file('avatar');
            // Générer un nom unique pour l'image
            $imageName = time().'_'.$image->getClientOriginalName();
            // Stocker l'image dans le répertoire 'public/images/avatars'
            $imagePath = $image->storeAs('images/avatars', $imageName, 'public');
        }  
        // Créer un compte dans la table `Compte`
        $compte = Compte::create([
            'nom_user' => $request->nom_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone'=>$request->phone,
            //'avatar'=>null,
            'adresse' => $request->adresse,//ca doit etre enlever
            'type_compte_id' => 3, // 3 pour Entreprise
            'avatar'=>$imagePath,
        ]);

        // Associer les détails spécifiques au résident
        Entreprise::create([
            'nom_entreprise' => $request->nom_entreprise,
            'service' => $request->service,
            'adresse' => $request->adresse, 
            'compte_id' => $compte->id,
        ]);
        
        // Rediriger l'utilisateur vers une page de confirmation ou vers le formulaire de connexion
       return redirect()->route('loginEntreprise')->with('status', 'Inscription réussie! Veuillez vous connecter.');
    }


    //La partie connection
    public function showLoginForm()
    {
        return view('auth.Entreprise_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:255|exists:comptes',
            'password' => 'required|string|',
        ],[ 
            'email.exists'=>'Cet email ne correspond pas a l\'email dans la BDD'
          ]);

          // Récupérer le compte par email
         $compte = Compte::where('email', $credentials['email'])->first();
         
         //Validation du type de compte
         if ($compte->type_compte_id == 3 && !$compte->is_validated) { // 3 pour Entreprise
            return back()->withErrors([
                'email' => 'Votre compte n\'a pas encore été validé par un administrateur.',
            ])->onlyInput('email');
        }
          
         // Vérifier si le type de compte correspond
          if ($compte->type_compte_id != 3) { // 1 pour Entreprise, à adapter selon le type
           return back()->withErrors([
            'email' => ' Ce compte ne correspond pas a aucune entreprise.',
            ])->onlyInput('email');
          }
          //dd($credentials);
          if (Auth::guard('entreprise')->attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'], // Si vous utilisez 'pwd' au lieu de 'password'
        ])) {
            $request->session()->regenerate();
            return redirect()->intended(route('annuaire'));
        }
            return to_route('loginEntreprise')->withErrors([
                'password'=>'Votre mot de passe est incorrect.'
            ])->onlyInput('password');
            
    }
}
