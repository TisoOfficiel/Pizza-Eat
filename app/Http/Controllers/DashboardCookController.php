<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class DashboardCookController extends Controller
{
    //
    public function showCommandeliste(){
        $commandes = Commande::where('statut','envoye')->orderBy('created_at','desc')->paginate(8);
        return view('cook.dashboardCommandeCook',['commandes'=>$commandes]);
    }

    public function updatestatutCommandeliste(Request $request,$id){

        $commande= Commande::where('id',$id)->first();
        
        $commande->statut = $request->statut;
        $commande->save();

        return redirect()->route('CookDashboard');
    }
}
