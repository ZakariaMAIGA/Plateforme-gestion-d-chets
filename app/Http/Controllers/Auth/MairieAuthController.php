<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use App\Models\Mairie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MairieAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.Mairie_register');
    }

    public function register(Request $request)
    {   
        $request->validate([
            'nom_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:comptes',
            'password' => 'required|string|min:8',
            //'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|min:8',
            'nom_mairie' => 'required|string|max:255',
            'commune' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Créer un compte dans la table `Compte`
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
            'type_compte_id' => 2, 
            'avatar'=>$imagePath,
        ]);
        
        // Associer les détails spécifiques au résident
        Mairie::create([
            'nom_mairie' => $request->nom_mairie,
            'commune' => $request->commune,
            'region' => $request->region, 
            'compte_id' => $compte->id,
        ]);
        
        // Rediriger l'utilisateur vers une page de confirmation ou vers le formulaire de connexion
       return redirect()->route('loginMairie')->with('status', 'Inscription réussie! Veuillez vous connecter.');
    }


    //La partie connection
    public function showLoginForm()
    {
        return view('auth.Mairie_login');
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

         //Validation du compte type mairie
         if ($compte->type_compte_id == 2 && !$compte->is_validated) { // 2 pour Mairie
            return back()->withErrors([
                'email' => 'Votre compte n\'a pas encore été validé par un administrateur.',
            ])->onlyInput('email');
        }
          
         // Vérifier si le type de compte correspond
          if ($compte->type_compte_id != 2) { // 2 pour Mairie, à adapter selon le type
           return back()->withErrors([
            'email' => ' Ce compte ne correspond pas a aucune mairie.',
            ])->onlyInput('email');
          }
          //dd($credentials);
          if (Auth::guard('mairie')->attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'], // Si vous utilisez 'pwd' au lieu de 'password'
        ])) {
            $request->session()->regenerate();
            return redirect()->intended(route('dasAutorite'));
        }
            return to_route('loginMairie')->withErrors([
                'password'=>'Votre mot de passe est incorrect.'
            ])->onlyInput('password');
            
    }
}
