<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
//     // La liste des utilisateurs
//     public function index()
//     {
//         $users = User::all();
//         return view('users.liste', compact('users'));
//     }

//    //Afficher le formulaire de creation
//  public function create_user(){
//     return view('users.ajouter');
//  }
//  //Validation des information de la creation
//  public function create_validate(Request $request)
//  {
    
//      $request->validate([
//          'prenom' => 'required|string|max:255',
//          'name' => 'required|string|max:255',
//          'email' => 'required|string|email|max:255|unique:users',
//       // 'password' => 'required|string|min:8|confirmed',  //confirmation du mot de passe
//          'password' => 'required|string|min:8',
//          'phone' => 'required|string|max:8',
//          'adresse' => 'required|string|max:255',
//          'role' => 'required|string|max:255',
//      ]);
 
//      $user = User::create([
//          'prenom' => $request->prenom,
//          'name' => $request->name,
//          'email' => $request->email,
//          'password' => Hash::make($request->password),
//          'phone' => $request->phone,
//          'adresse' => $request->adresse,
//          'role' => $request->role,
//      ]);
    
         
//      $user->save();
//      return redirect()->route('users.index')->with('status','L\'utilisateur  a ete ajoute  avec succes.');
//     }
//   // Afficher le formulaire d'édition
//     public function edit($id)
//     {
//         $user = User::find($id);
//         return view('users.update', compact('user'));
//     }

//  // Mettre à jour les informations de l'utilisateur
//     public function update(Request $request, $id)
//     {
//         $request->validate([
//             'prenom' => 'required|string|max:255',
//             'name' => 'required|string|max:255',
//             'email' => 'required|string|email|max:255|unique:users,email,' . $id,
//             'phone' => 'required|string|max:8',
//             'adresse' => 'required|string|max:255',
//             'role' => 'required|string|max:255',
//         ]);

//         $user = User::find($id);
//         $user->prenom = $request->prenom;
//         $user->name = $request->name;
//         $user->email = $request->email;
//         $user->phone = $request->phone;
//         $user->adresse = $request->adresse;
//         $user->role = $request->role;

//         if ($request->filled('password')) {
//             $request->validate([
//                 'password' => 'required|string|min:8',
//             ]);
//             $user->password = Hash::make($request->password);
//         }

//         $user->update();

//         return redirect()->route('users.index')->with('status', 'Le compte a été mis à jour avec succès.');
//     }
    
//     public function destroy($id)
//     {
//         $user = User::find($id);

//         if ($user) {
//             $user->delete();
//             return redirect()->route('users.index')->with('status', 'Utilisateur supprimé avec succès.');
//         } else {
//             return redirect()->route('users.index')->with('error', 'Utilisateur non trouvé.');
//         }
//     }
}
