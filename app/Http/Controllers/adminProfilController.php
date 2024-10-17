<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class adminProfilController extends Controller
{
    

    public function showProfile()
    {
        // Récupérer le compte et les informations du résident connecté
        $compte = Auth::guard('admin')->user(); // Récupérer le résident connecté
        $admin = $compte->admin; // Récupérer le compte associé au résident
        
        return view('admin.profile', compact('admin', 'compte'));
    }

    // Mettre à jour le profil du résident connecté
    public function updateProfile(Request $request)
    {
        // Récupérer le résident et le compte associés
        $compte = Auth::guard('admin')->user();
        $admin = $compte->admin; 
    
        // Valider les informations du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:comptes,email,' . $compte->id,
            'phone' => 'required|string|min:8',
            'adresse' => 'required|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_password' => 'required_with:password|string', // Ancien mot de passe obligatoire si on change le mot de passe
            'password' => 'nullable|string|min:8|confirmed', // Validation du nouveau mot de passe et confirmation
        ]);
    
        // Si un avatar est présent, le mettre à jour
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('images/avatars', $imageName, 'public');
            $compte->avatar = $imagePath; // Mettre à jour l'avatar
        }
    
        // Vérifier si l'utilisateur souhaite mettre à jour le mot de passe
        if ($request->filled('password')) {
            // Vérifier si l'ancien mot de passe est correct
            if (!Hash::check($request->current_password, $compte->password)) {
                return back()->withErrors(['current_password' => 'L\'ancien mot de passe est incorrect.']);
            }
    
            // Mettre à jour le mot de passe
            $compte->password = Hash::make($request->password);
        }
    
        // Mise à jour des informations du résident
        $admin->nom = $request->nom;
        $admin->prenom = $request->prenom;
        $admin->save();
       //dd($admin);
    
        // Mise à jour des informations du compte
        $compte= new Compte();
        $compte->email = $request->email;
        $compte->phone = $request->phone;
        $compte->adresse = $request->adresse;
    
        // Sauvegarder le compte après les modifications
        $compte->save();
       // dd($compte);
    
        return redirect()->route('admin.profile')->with('status', 'Profil mis à jour avec succès.');
    }


}