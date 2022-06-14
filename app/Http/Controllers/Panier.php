<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Panier extends Controller
{   

    public function resetPanier(Request $request,$id){

        $user = Auth::user()->id;
    
        if($user==$id){
            session()->forget('panier');
            return redirect('/');
        }else{ 
            return redirect('/');
        }
    }

    public function Panier_add(Request $request,$id){
        
       
        $pizza = Pizza::findOrFail($id);
        $panier = session()->get('panier');
        $total = 0;
        
        
        if($request->statue=="add"||$request->selectquantite>0){
           
            if(isset($panier[$id])) {
                if($request->statue=="add"){    
                    $quantite = $panier[$id]['quantite']++;
                }else{
                    $panier[$id]['quantite'] = $request->selectquantite;
                }
              
            } else {
                
                $panier[$id] = [
                    "id"=> $pizza->id,
                    "nom" => $pizza->nom,
                    "prix" => $pizza->prix,
                    "quantite" => 1,
                ];
            }

        }elseif($request->selectquantite=="0"){
            
            
            if(isset($panier[$id])) {

                    session()->pull('panier.'.$id);
                   
                    return redirect()->back();
            }

        }elseif($request->statue=="remove"){

            if(isset($panier[$id])) {

                if($panier[$id]['quantite']>0){

                    $panier[$id]['quantite']--;
                    session()->put('panier', $panier);

                }if($panier[$id]['quantite']==0){
        
                    session()->pull('panier.'.$id);
                   
                    return redirect()->back();
                }
            }
        }            
            
        session()->put('panier', $panier);
                
        return redirect()->back();
    }

    
}
