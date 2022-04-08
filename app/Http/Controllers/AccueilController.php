<?php

namespace App\Http\Controllers;

use App\Models\Visiteurs;
use Illuminate\Support\Facades\Auth;

class AccueilController extends Controller
{
    public function accueil(){
        $user = Visiteurs::select('VIS_NOM', 'VIS_PRENOM')
            ->where('VIS_NOM', Auth::user()->VIS_NOM)
            ->first();

        return view('accueil', [
            'user' => $user
        ]);
    }
}
