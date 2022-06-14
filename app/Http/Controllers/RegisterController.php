<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;





class RegisterController extends Controller
{

    public function showRegisterForm(){
        $users=User::all();
        return view('auth.register',['users'=>$users]);
    }

    public function add(Request $request){
        
        $request->validate([
            'nom' => ['required','string','max:255',],
            'prenom'=>['required','string','max:255'],
            'login'=>['required','string','max:255','unique:users'],
            'mdp'=>['required','confirmed'],
            
        ]);
        
        
        $user = new User();
        $user->nom = $request->nom;
        $user->prenom=$request->prenom;
        $user->login=$request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->save();
        
        session()->flash('etat','User added');
        
        Auth::login($user);

        return redirect('/');
    }
}


