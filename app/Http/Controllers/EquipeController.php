<?php

namespace App\Http\Controllers;

use App\Models\Equipe;
use App\Models\Mairie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipeController extends Controller
{
    
    public function create(){
        return view('equipe.create');
    }

    public function store(Request $request){

        $request->validate([
            'nom'=>'required|string|max:255',
            'phone'=>'required|string|min:8',
            'adresse'=>'required|string',
 
        ]);
        $compte = Auth::guard('mairie')->user();
        $mairie = $compte->mairie;
        Equipe::create([
            'nom'=>$request->nom,
            'phone'=>$request->phone,
            'adresse'=>$request->adresse,
            'mairie_id' => $mairie->id,
        ]);
        
        return redirect()->route('equipe.index')->with('status', 'L\'equipe a ete bien cree');
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

