<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;
use App\Models\User; //class importe
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
//     //Pour la connection(login) de l'utilisateur
//     public function showConnectionForm(){

//         return view('auth.longin');
//     }
//     //Pour la validation de la conncetion avec Request
//     public function dologin(Request $request)
//     {
//       $credentials = $request->validate([
//         'email' => 'required|string|email|max:255|',
//         'password' => 'required|string|min:8',

//       ]);
//        if(Auth::attempt($credentials )){
//         $request->session()->regenerate();
//         return redirect()->intended(route('layouts.index'));
//        }
//         return to_route('login')->withErrors([
//             'password'=>'Votre mot de passe est incorrect.'
//         ])->onlyInput('password');
     
//     }
// //Pour l'enregistrement(register) d'utilisateur
     
//     public function showRegistrationForm(){
   
//         return view('auth.register');
//       }
     
//     //Pour la validation de l'enregistrement d'User avec Request
//    public function register(Request $request)
//    {
      
//        $request->validate([
//            'prenom' => 'required|string|max:255',
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|max:255|unique:users',
//         //    'password' => 'required|string|min:8|confirmed',  //confirmation du mot de passe
//            'password' => 'required|string|min:8',
//            'phone' => 'required|string|max:8',
//            'adresse' => 'required|string|max:255',
//            'role' => 'required|string|max:255',
//        ]);
   
//        $user = User::create([
//            'prenom' => $request->prenom,
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//            'phone' => $request->phone,
//            'adresse' => $request->adresse,
//            'role' => $request->role,
//        ]);
   
//        // Connexion de l'utilisateur après enregistrement
//        auth()->login($user);
   
//        return redirect()->route('login')->with('status','Le compte a ete creer  avec succes.');
//    }


//    //Pour la deconnection
//    public function logout(Request $request)
//     {
//         Auth::logout();

//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return redirect('/login');
//     }


   
}
