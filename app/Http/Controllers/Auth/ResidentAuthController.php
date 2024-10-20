<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Compte;
use App\Models\Resident;
use App\Models\TypeCompte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResidentAuthController extends Controller
{
    public function showRegistrationForm()
    {
        $type_comptes = TypeCompte::all();
        return view('auth.Resident_register',compact('type_comptes'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom_user' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:comptes',
            'password' => 'required|string|min:8',
            //'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:8',
            'nom_resident' => 'required|string|max:255',
            'prenom_resident' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'type_compte' => 'required|integer|exists:type_comptes,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ],
        [
            'nom_user.required' => 'Le nom utilisateur est requis.',
            'email.required' => 'L\'email doit etre requis.',
            'password.required' => 'Le mot de passe est requis et max 8 chiffres.',
            'phone.required' => 'Le numero est obligatoire.',
            'adresse.required' => 'L\'adresse est requis.',
            'nom_resident.required' => 'Le nom est requis.',
            'prenom_resident.required' => 'Le prenom est requis.',
            'type_compte.required'=>'Le type de compte est obligatoire',
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
            'type_compte_id' => $request->type_compte, // Utilisation de la valeur du formulaire
            'avatar'=>$imagePath,
        ]);

        // Associer les détails spécifiques au résident
        Resident::create([
            'nom_resident' => $request->nom_resident,
            'prenom_resident' => $request->prenom_resident,
            'adresse' => $request->adresse, 
            'compte_id' => $compte->id,
        ]);
        
        // Rediriger l'utilisateur vers une page de confirmation ou vers le formulaire de connexion
       return redirect()->route('login')->with('status', 'Inscription réussie! Veuillez vous connecter.');
    }


    //La partie connection
    public function showLoginForm()
    {
        return view('auth.resident_login');
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
          
         // Vérifier si le type de compte correspond
          if ($compte->type_compte_id != 1) { // 1 pour Resident, à adapter selon le type
           return back()->withErrors([
            'email' => 'Vous ne pouvez pas vous connecter ici avec ce compte.',
            ])->onlyInput('email');
          }
          //dd($credentials);
          if (Auth::guard('resident')->attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'], // Si vous utilisez 'pwd' au lieu de 'password'
        ])) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashResident'));
        }
            return to_route('login')->withErrors([
                'password'=>'Votre mot de passe est incorrect.'
            ])->onlyInput('password');
            // return back()->withErrors([
            //     'login_error' => 'Les informations d\'identification ne sont pas correctes ou l\'utilisateur n\'existe pas.',
            // ])->withInput($request->only('email'));
    }


    public function logoutResident(Request $request)
    {
        Auth::guard('resident')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.resident'); // Redirige vers la page de connexion des résidents
    }


    //Redirection vers les differents dashbord
    // return redirect()->route('resident.dashboard');  // Pour les résidents
    // return redirect()->route('maire.dashboard');     // Pour les maires
    // return redirect()->route('entreprise.dashboard'); // Pour les entreprises
 

}
