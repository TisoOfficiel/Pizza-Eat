<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserCompte extends Controller
{
    public function userSettings(Request $request,$id){
        
        
        $user = Auth::user()->id;
        
       

        if($user==$id){
            return view('user.userSetting');
        }else{ 
            return redirect('/');
        }
        
        
    }

    public function EditUser(Request $request,$id){
        $user = Auth::user()->id;
    
        if($user==$id){
            $validator = Validator::make($request->all(),[       
                'newNom' => ['required','alpha'],
                'newPrenom'=>['required','alpha'],
                'newLogin'=>['required',"alpha"],
            ]);
            
            if($validator->fails()){
                
                return redirect()->back()->withInput();
                    
            }else{
                
                
                
                $utilisateur=User::where('id',$user)->first();

                // On modifie chaque valeur par les nouvelles qu'on a reçut
                $utilisateur->nom=$request->newNom;
                $utilisateur->prenom=$request->newPrenom;
                $utilisateur->login=$request->newLogin;

                // On sauvegarde
                $utilisateur->save();
                
                return redirect()->route('UserSettings', [$user]);
                return redirect("/{{Auth::user()->login}}/compteSetting");
                
            }
        }else{ 
            return redirect('/');
        }
        
    }
    public function editMotDePasse(Request $request){
        
        $user = Auth::user();

        $request->validate([
            'mdpActuel' => ['required'],
            'mdpNew'=>['required','confirmed'],
        ]);

        
        $mdpActuel = Auth::user()->mdp;
        
        if (Hash::check($request->mdpActuel,$mdpActuel)) {
            
            if(!Hash::check($request->mdpNew,$mdpActuel)){
                
                $user->mdp = Hash::make($request->mdpNew);

                $user->save();

                return redirect()->back()->with('etat','Modification réussite');

            }else{
                return redirect()->back()->with('etat','Modification raté')->withInput();
            }
           
        }else{
            return redirect()->back()->with('etat','Modification raté')->withInput();
        }
    }

    public function suppresionCompteUser(Request $request,$id){
        
        $user = Auth::user()->id;
        
        if($user==$id){
            User::where('id',$user)->first()->delete();
            

            return redirect('/');
        }else{
            return redirect('/');
        }

        // Puis on retourne sur la page principale avec un message flash de succés
        $request->session()->flash('sucessSuppression','Suppression effectué');
        return redirect()->route('home');
    }
}
