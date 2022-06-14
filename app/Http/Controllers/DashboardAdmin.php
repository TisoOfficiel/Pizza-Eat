<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pizza;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardAdmin extends Controller
{
    
    //

    public function showDashboad (){

        $dateToday = date('Y-m-d');
        
        $commandedujour = Commande::whereBetween('created_at', [$dateToday.' 00:00:00', $dateToday.' 23:59:59'])->get();
        $commandes= Commande::orderBy('created_at','desc')->take(6)->get();
        
   
        $users=User::all();
        $usercount=$users->count();
        $usersrecent = User::orderBy('id', 'desc')->simplePaginate(3);
        $pizzas = Pizza::all();
        $countpizzas = $pizzas->count();
        $countcommande = Commande::all()->count();
        return view('admin.dashboard.overview',['users'=>$users,'usersrecent'=>$usersrecent,'usercount'=>$usercount,'countpizzas'=>$countpizzas,'countcommande'=>$countcommande,'commandedujour'=>$commandedujour,'commandes'=>$commandes]);
    }


    //Début concernant les pizzas

    // Affichage des pizzas
    public function showDashboadPizza(Request $request){       
        
        $pizzas = Pizza::all();
        $dateFrom = $request->dateFrom;
        $countpizzas = $pizzas->count();
        $pizzasPaginate = Pizza::paginate(6);
        
        if($dateFrom!=null){
            $pizzasPaginate=Pizza::whereBetween('updated_at', [$dateFrom.' 00:00:00', $dateFrom.' 23:59:59'])->paginate(6);
            session()->flashInput($request->input());
            
            return view('admin.dashboard.pizza',['pizzas'=>$pizzas,'pizzasPaginate'=>$pizzasPaginate,'countpizzas'=>$countpizzas]);
        }
        
        session()->flashInput($request->input());
        return view('admin.dashboard.pizza',['pizzas'=>$pizzas,'pizzasPaginate'=>$pizzasPaginate,'countpizzas'=>$countpizzas]);
    }

    
  
    //Ajout de pizza
    public function PizzaAdd(Request $request){

        $request->validate([
            'NomPizza' => ['required','string','max:255','unique:pizzas'],
            'DescriptionPizza'=>['required','string','max:255'],
            'PrixPizza'=>['required','string','max:255'],
           
            'fichier' => 'required|mimes:txt,pdf,jpg|max:2048',
            ]);     
           
        
        $pizza = new Pizza();

        $pizza->nom = $request->NomPizza;
        $pizza->description=$request->DescriptionPizza;
        $pizza->prix=$request->PrixPizza;
        
        $pizza->save();
        
        $path = $request->file('fichier')->storeAs('img_pizza'
        ,$pizza->id.".png",'public');
        return redirect()->route('dashboardPizza');

    }


    // Modification de pizza
    public function ModificationPizza(Request $request,$id){
        
        $request->validate([
            'NewPizzaNom' => ['required','string','max:255','unique:pizzas'],
            'NewPizzaDescription'=>['required','string','max:255'],
            'NewPrixPizza'=>['required','string','max:255'],
            'Newfichier' => 'required|mimes:txt,pdf,jpg|max:2048',
        ]);   

        $pizza = Pizza::find($id);
        
        $pizza->nom = $request->NewPizzaNom;
        $pizza->description=$request->NewPizzaDescription;
        $pizza->prix=$request->NewPrixPizza;
        $pizza->save();

        $path = $request->file('Newfichier')->storeAs('img_pizza'
        ,$pizza->id.".png",'public');

        return redirect()->back();
    }

    public function RemovePizza(Request $request,$id){
        $pizzaDelete = Pizza::find($id);
        $commandes = Commande::all();
        
       
        $presence = 0;

        foreach($commandes as $commande){
            foreach($commande->pizzas as $pizza){
                
                if($pizzaDelete->id==$pizza->id){
                    
                    $presence=true;
                    break;
                    
                }
            }
        }
         
        if($presence){
            $pizzaDelete->delete();
        }else{
            $pizzaDelete->forceDelete();;
        }

        return redirect()->back();
    }
    // Fin  concernant les pizzas

    // Début des utilisateurs

    // Affichage de la liste des utilisateurs 

    public function showUserList(){

        $utilisateurs= User::paginate(6);
        $countUser = User::all()->where('type','user')->count();
        $countAdmin = User::all()->where('type','admin')->count();
        $countCook = User::all()->where('type','cook')->count();

        $roleactif="none";
        return view('admin.dashboard.utilisateurs',['utilisateurs'=>$utilisateurs,'roleactif'=>$roleactif]);
    }

    public function showUserListFilter(Request $request){
      

        switch($request->role) {
            case('Voir Tout'):
                return redirect()->route('dashboardUser');
            break;

            case('Utilisateur'):
            $utilisateurs= User::where('type','user')->paginate(6);
            $roleactif="user";
            break;

            case('Cuisinier'):
            $utilisateurs= User::where('type','cook')->paginate(6);
            $roleactif="cook";
            break;
            
            case('Admin'):
            $utilisateurs= User::where('type','admin')->paginate(6);
            $roleactif="admin";
            break;

        }
        return view('admin.dashboard.utilisateurs',['utilisateurs'=>$utilisateurs,'roleactif'=>$roleactif]);
    }

    public function updaterole(request $request,$id){

        $user= User::where('id',$id)->first();
        $user->type = $request->role;
        $user->save();

        
    
        if($user->id==Auth::user()->id){
            return redirect()->route('logout');
        }
        return redirect()->back();
    }

    public function createmember(Request $request){
        
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
        $user->type=$request->roleuser;
        $user->mdp = Hash::make($request->mdp);
        
        $user->save();
        
        session()->flash('etat','User added');

        return redirect()->back();
    }

    public function editmemberView(request $request,$id){
        $user = User::where('id',$id)->first();

        return view('admin.dashboard.editmember',['user'=>$user]);

    }

    public function editmember(request $request,$id){
        $user = User::where('id',$id)->first();

        $request->validate([
            'mdpNew'=>['required','confirmed'],
        ]);

        
                
                $user->mdp = Hash::make($request->mdpNew);

                $user->save();

                return redirect()->back()->with('etat','Modification réussite');

    }

    public function removemember(Request $request,$id){
          
        User::where('id',$id)->first()->delete();
        
        // Puis on retourne sur la page principale avec un message flash de succés
        $request->session()->flash('sucessSuppression','Suppression effectué');
        return redirect()->route('dashboardUser');
        
    }


    // Fin des utilisateurs

    // Début des Commandes Liste 

        public function showCommmandeListe(Request $request){
            $commandes = Commande::paginate(8);
            
            $dateFrom = $request->dateFrom;
            $commandeDuJour = $request->cmdJ;
            
            $dateToday = date('Y-m-d');
        
           
            
            if($commandeDuJour=="Commandes du Jour"){
                $commandes = Commande::whereBetween('created_at', [$dateToday.' 00:00:00', $dateToday.' 23:59:59'])->orderBy('statut','asc')->orderBy('created_at','desc')->paginate(1000000000);
                // $commandes = Commande::whereDate('created_at',date("Y-m-d H:i:s"))->orderBy('statut','desc')->orderBy('created_at','desc')->paginate(8);
                
                return view('admin.dashboard.commandeListe',['commandes'=>$commandes]);
            }
            if($dateFrom!=null){

                $commandes=Commande::whereBetween('created_at', [$dateFrom." 00:00:00",$dateFrom." 23:59:59"])->paginate(1000000000);
                // $commandes=Commande::whereBetween('created_at','=',date('Y-m-16'))->paginate(8);
                session()->flashInput($request->input());
                return view('admin.dashboard.commandeListe',['commandes'=>$commandes]);
                
            }

            if($request->statut=="all")
            {   
                $commandes = Commande::orderBy('created_at','desc')->Paginate(8);
                session()->flashInput($request->input());
                return view('admin.dashboard.commandeListe',['commandes'=>$commandes]);
            }elseif ($request->statut!=null) {
                $commandes = Commande::where('statut',$request->statut)->orderBy('created_at','desc')->Paginate(1000000000);
                session()->flashInput($request->input());
                return view('admin.dashboard.commandeListe',['commandes'=>$commandes]);
            }else{
                $commandes = Commande::orderBy('created_at','desc')->Paginate(8);
                return view('admin.dashboard.commandeListe',['commandes'=>$commandes]);
            }      
            return view('admin.dashboard.commandeListe',['commandes'=>$commandes]);
        }
    // Fin des Commandes
}
