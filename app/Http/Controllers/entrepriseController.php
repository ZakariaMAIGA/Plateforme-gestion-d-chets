<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class entrepriseController extends Controller
{
    public function entre_annuaire(){
        return view('entreprise.annuaire');
    }
}
