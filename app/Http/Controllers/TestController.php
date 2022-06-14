<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pizza;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class TestController extends Controller
{
    public function testrelation(){
        
        $paniers = session()->get('panier');
        
        $user = User::findorfail(Auth::user()->id);
        
        $commande = new Commande();
        $commande->user_id = Auth::user()->id;
        $commande->statut = "envoye";
        
        $user->commandes()->save($commande);

        foreach($paniers as $panier){
           
            $commande->pizzas()->attach($panier['id'],['qte'=>$panier['quantite']]);
            // $commande_pizza = new CommandePizza();

            // $commande_pizza->commande_id=$commande->id;

            // $commande_pizza->pizza_id = $panier['id'];

            // $commande_pizza->qte = $panier['quantite'];

            // $commande_pizza->save();
        }
        
        $commandes = User::find(Auth::user()->id)->commandes;
        
        foreach ($commandes as $commande) {
            echo $commande->id;
        }

        
        // return view('test',['commandes'=>$commande]);
        
    }









    public function ShowPanier(){

        $pizzas = Pizza::all();
        
        return view('panier.panier_form',['pizzas'=>$pizzas]);
    }


    public function test(Request $request){
        return view('test');
    }



    public function produitsListPaginate(Request $request){
    $p = User::orderBy('id', 'desc')->simplePaginate(3);
    // ou
    // $p = Produit::where('id','>','10')->paginate(15);
    return view('produits.list_paginate',['users'=>$p]);
}
public function commander(){
    $panier = session()->get('panier');
    
    return view('panier.checkpanier',['paniers'=>$panier]);
}

public function storageDownload(){
    
    return view('test');
}

public function storageUploadForm(){
    return view('upload.form');
    }




    public function storageUpload(Request $request){
        $request->validate([
        'fichier' => 'required|mimes:txt,pdf,jpg|max:2048'
        ]);
        
        $path = $request->file('fichier')->storeAs('img_pizzatest'
        ,'f_'.".png",'public');
        
        return redirect('/');
        }
}



