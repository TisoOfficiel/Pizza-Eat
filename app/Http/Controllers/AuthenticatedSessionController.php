<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;

class AuthenticatedSessionController extends Controller
{
    //

    public function showForm(){
        return view('auth.login');
    }

    public function logout(Request $request){
       
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function login(Request $request){

        $request->validate([
            'login' => 'required|string',
            'mdp' => 'required'
            ]);

        
        $credentials = ['login' => $request->input('login'), 'password' => $request->input('mdp')];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $request->session()->flash('etat','Login successful');

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ]);
    }


    public function show_form_mdp_changer(Request $request){
           
        return view('mdp_form');
        
    }   


    public function mdp_changer(Request $request,$login){
        
        $utilisateur=User::where('login',$login)->first();

        $utilisateur->mdp=Hash::make($request->mdpNew);
        
        $utilisateur->save();

        return redirect('/');
    }

    
}
