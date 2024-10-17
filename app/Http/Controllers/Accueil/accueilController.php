<?php

namespace App\Http\Controllers\Accueil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class accueilController extends Controller
{
   public function viewaccueil(){
    return view('accueil.accueil');
   }

   public function about(){
    return view('accueil.about');
   }
   public function contact(){
    return view('accueil.contact');
   }
}
