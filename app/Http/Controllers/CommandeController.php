<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\CommandePizza;
use App\Http\Controllers\Panier;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function commander(){
        $panier = session()->get('panier');
        
        return view('panier.checkpanier',['paniers'=>$panier]);
    }

    public function Commande_add(){
        $paniers = session()->get('panier');
        
        $user = User::findorfail(Auth::user()->id);
        
        $commande = new Commande();
        $commande->user_id = Auth::user()->id;
        $commande->statut = "envoye";
        
        $user->commandes()->save($commande);

       
        
        foreach($paniers as $panier){
           
            $commande->pizzas()->attach($panier['id'],['qte'=>$panier['quantite']]);
        }
        
       
        // $paniers = session()->get('panier');
        
        // $commande = new Commande();
        // $commande->user_id = Auth::user()->id;
        // $commande->statut = "envoye";
        
        // $commande->save();

        // foreach($paniers as $panier){
        //     $commande_pizza = new CommandePizza();

        //     $commande_pizza->commande_id=$commande->id;

        //     $commande_pizza->pizza_id = $panier['id'];

        //     $commande_pizza->qte = $panier['quantite'];

        //     $commande_pizza->save();
        // }
        return redirect()->route('resetPanier',['id'=>Auth::user()->id]);
        
    }

    public function ShowCommandes(Request $request,$id){

        $user = Auth::user()->id;


        $commandes = User::find(Auth::user()->id)->commandes()->orderBy('created_at','desc')->Paginate(8);

        // $commandes = Commande::where('user_id',$user)->get();
        
        // $commandes_pizza = Commande::where('user_id',$user)->get();
        
        // $commandes_pizzas = CommandePizza::where('commande_id',16)->first();
       

        // foreach($commandes as $commande){
        //     $commandes_pizzas = CommandePizza::where('commande_id',$commande->id)->get();  
        // }   
        
        if($user==$id){
            return view('user.Usercommande',['commandes'=>$commandes]);
        }else{ 
            return redirect('/');
        }
        
    }


    public function filterCommandeStatut(Request $request,$id){
        
        $user = Auth::user()->id;
        if($user==$id){
            if($request->statut=="all")
            {   
                $commandes = User::find(Auth::user()->id)->commandes()->orderBy('created_at','desc')->Paginate(8);
                session()->flashInput($request->input());
                return view('user.Usercommande',['commandes'=>$commandes]);
            }elseif ($request->statut!=null) {
                $commandes = User::find(Auth::user()->id)->commandes()->where('statut',$request->statut)->orderBy('created_at','desc')->Paginate(10000000);
                session()->flashInput($request->input());
                return view('user.Usercommande',['commandes'=>$commandes]);
            }else{
                $commandes = User::find(Auth::user()->id)->commandes()->orderBy('created_at','desc')->Paginate(8);
                return view('user.Usercommande',['commandes'=>$commandes]);
            }          
            
            
        }else{ 
            return redirect('/');
        }
    }


    public function ShowDetailCommande(Request $request,$cid,$id){

        if(Auth::user()->id==$id || Auth::user()->type=="admin" || Auth::user()->type=="cook"){

            $user= User::find($id);
            $commande = Commande::find($cid);
            
            return view('commandeDetails',['user'=>$user,'commande'=>$commande]);
        }else{
            return redirect('/');
        }
    }
}
