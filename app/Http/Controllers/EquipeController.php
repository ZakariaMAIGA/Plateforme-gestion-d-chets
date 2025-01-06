<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Equipe;
use App\Models\Mairie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class EquipeController extends Controller
{
    
    public function create(){
        return view('equipe.create');
    }

    public function store(Request $request){
        //dd($request->all());
        $request->validate([
            'nom'=>'required|string|max:255',
            'phone'=>'required|string|min:8',
            'adresse'=>'required|string',
            // ajout des attributs du compte
            // 'nom_user' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:comptes',
            // 'password' => 'required|string|min:8',
            // 'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ],
            [
                'nom_user.required' => 'Le nom utilisateur est requis.',
                'email.required' => 'L\'email doit etre requis.',
                'password.required' => 'Le mot de passe est requis et max 8 chiffres.',
                'phone.required' => 'Le numero est obligatoire.',
                'adresse.required' => 'L\'adresse est requis.',
                'nom.required' => 'Le nom est requis.',  
        ]);
     // Telechargement de l'image
//      if ($request->hasFile('avatar')) {
//         // Récupérer le fichier image
//         $image = $request->file('avatar');
//         // Générer un nom unique pour l'image
//         $imageName = time().'_'.$image->getClientOriginalName();
//         // Stocker l'image dans le répertoire 'public/images/avatars'
//         $imagePath = $image->storeAs('images/avatars', $imageName, 'public');
//     }
 
//     // Création du compte du chef d'équipe
//     $chefCompte = Compte::create([
//         'nom_user' => $request->nom_user,
//         'email' => $request->email,
//         'password' => Hash::make($request->password),
//         'phone' => $request->phone,
//         'adresse' => $request->adresse,
//         'type_compte_id' => 5, // Type "Chef d'équipe"
//         'avatar' => $imagePath,
//     ]);
//    // Log::info('Compte chef créé avec succès.', ['id' => $chefCompte->id]);
//     dd($chefCompte);

        $compte = Auth::guard('mairie')->user();
        $mairie = $compte->mairie;
        Equipe::create([
            'nom'=>$request->nom,
            'phone'=>$request->phone,
            'adresse'=>$request->adresse,
            'mairie_id' => $mairie->id,
            //'compte_id' => $chefCompte, // Associe le chef d'équipe
        ]);
        //dd($equipe);
        
        return redirect()->route('equipe.index')->with('status', 'L\'equipe a été bien crée');
    }


    public function index()
    {
        $compteId = Auth::guard('mairie')->id();
        $mairie= Mairie::where('compte_id', $compteId)->first();
        $equipes = Equipe::where('mairie_id', $mairie->id)->get();
       

        return view('equipe.liste', compact('equipes'));
    }



    public function edit(Equipe $equipe){


        $compteId = Auth::guard('mairie')->id();
        
         $mairie = Mairie::where('compte_id', $compteId)->first();
          
      if ($equipe->mairie_id != $mairie->id) {

      abort(403, 'Accès non autorisé');

     }
        return view('equipe.update', compact('equipe'));
    }



    public function update(Request $request, Equipe $equipe){
        
        
        $compteId = Auth::guard('mairie')->id();
        
         $mairie = Mairie::where('compte_id', $compteId)->first();

    //   if ($equipe->mairie_id != $mairie->id) { J'ai commente celui la car il n'arrive a verifier la condition
       
    //   abort(403, 'Accès non autorisé');

    //  }

    $request->validate([
        'nom'=>'required|string|max:255',
        'phone'=>'required|string|min:8',
        'adresse'=>'required|string',
         

    ]);

    $equipe->update([

        'nom'=>$request->nom,
        'phone'=>$request->phone,
        'adresse'=>$request->adresse,
        'mairie_id' => $mairie->id,

    ]);
    
  

    return redirect()->route('equipe.index')->with('status', 'L\'equipe a ete bien edite');
    }


    public function destroy(Equipe $equipe){

        $compteId = Auth::guard('mairie')->id();
        
        $mairie = Mairie::where('compte_id', $compteId)->first();
     

     if ($equipe->mairie_id != $mairie->id) {
        
     abort(403, 'Accès non autorisé');

    }
    $equipe->delete();


    return redirect()->route('equipe.index')->with('status', 'L\'equipe a ete bien supprime');
    }

}

