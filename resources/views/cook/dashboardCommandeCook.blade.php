@extends('layout.app')

@section ('linkCSS','/css/menu_vertical.css')
@section ('linkCSS1','/css/dashboard/dashboard_nav_bar.css')
@section ('linkCSS2','/css/cook/dashboardCommandeCook.css')


@section('content')

    
<div class="menuContainer">
    <!-- Menu de navigation horizontal -->
    <div>
        <i id="menuicon" class="material-icons" onclick="openNav()"> menu</i>
    </div>

    <!-- Logo -->
    <div>
        <a href="/"><img src="/img/logo_pizza1.png" class="logo"></a>
    </div>
    
   <!-- affichafe personne connecter -->

    <div id="infoUser" class="infoUser" onclick="dropdownmenu()">

        @if(Auth::user()->type=='admin')
            <i id="adminIcon" class="material-icons">verified</i>
        @endif
        @if(Auth::user()->type=='cook')
            <i id="adminIcon" class="material-icons">soup_kitchen</i>
        @endif
        
        <p>{{Auth::user()->prenom}}</p>
        <i class="material-icons">expand_more</i>
        <div id="infoUserDropdown" class="infoUserDropdown">
            <div class="infoUserDropdownTitle">
                <p class="infoUserDropdownAuthTitle">Enregistrer comme</p>
                <p class="infoUserDropdownAuth">{{Auth::user()-> nom}} {{Auth::user()-> prenom}}</p>
            </div>

           <div class="infoUserDropdownContent">
                <a href="/">
                    <div class="infoUserDropdownAccueil">
                        <i class="material-icons">home</i>
                        <p>Accueil</p>
                    </div>
                </a>

                <a href="{{route('UserSettings',['id'=>Auth::user()->id])}}">
                    <div class="infoUserDropdownModifierProfile">
                        <i class="material-icons">edit</i>
                        <p>Modifier son profile</p>
                    </div>
                </a>
           </div>

            <a href="{{route('logout')}}">
                <div class="infoUserDropdownLogout">
                    <i class="material-icons">logout</i>
                    <p>Se déconnecter</p>
                </div>
            </a>
        </div>
   </div>

</div>

<div class="containersidebar" id ="containersidebar">
    <div id="mySidenav" class="sidenav">
        
        <i class="material-icons" id="closenav" onclick="closeNav()">close</i>

        <div class="profileContainer">
            <div class="profileIcone">
            <i id="personneIcon"class="material-icons">person</i>
        </div>
            
            <div class="profileInfo">
                <p>
                    {{Auth::user()->prenom}}
                    @if(Auth::user()->type=='admin')
                        <i id="adminIcon" class="material-icons">verified</i>
                    @endif
                    @if(Auth::user()->type=='cook')
                         <i id="adminIcon" class="material-icons">soup_kitchen</i>
                    @endif
                </p>
                <a href="/{{Auth::user()->id}}/compteSetting">Voir le compte</a>
            </div>
        </div>
                    
        @if(Auth::user()->type=='admin')
            <div class="sidenavdashboard">
                <i class="material-icons">dashboard</i>
                <a href="{{route('dashboard')}}" class="sidenavlist">Dashboard</a>
            </div>
        @endif
        @if(Auth::user()->type=='cook')
                <div class="sidenavdashboard">
                    <i class="material-icons">dashboard</i>
                    <a href="{{route('CookDashboard')}}" class="sidenavlist">Dashboard</a>
                </div>
        @endif
        <div class="sidenavCommande">
            <i class="material-icons">bookmark</i>
            <a href="{{route('commandeView',['id'=>Auth::user()->id])}}" class="sidenavlist">Commandes</a>
        </div>

        <div class="sidenavChangementCompte">
            <i class="material-icons">switch_account</i>
            <a href="#"class="sidenavlist">Changer de compte</a>
        </div>  

        <div class="sidenavdeconnexion">
            <i class="material-icons">logout</i>   
            <a href="{{route('logout')}}"class="sidenavlist">Déconnexion</a>
        </div>
    </div>
</div>

<div class="commandeUserContainer">
    <div class="commandeUserContent">
        <div>
            <h1>Listes commande</h1>
        </div>
        <div class="commandeUserContentBody">
            <div class="commandeUserContentBodyHeader">

                
            </div>
            
                <table class="tablecontentUserCommande">
                    <thead>
                        <tr class="tablecontentUserCommandeHeader">
                            <th>#UID</th>
                            <th>Nom Prénom</th>
                            <th>#CID</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody>
                    @foreach($commandes as $commande)
                        <tr class="tablecontentUserCommandeInfo">
                            <td>#{{$commande->user_id}}</td>
                               
                            <td>{{$commande->user->nom}} {{$commande->user->prenom}}</td>
                            <td>#{{$commande->id}}</td>
                            
                            
                            <td class="statutCellule">
                                <div class="statutEnvoye">Envoyé</div>
                                <div class="statutSelect">

                                    
                                    <form action="{{route('udpateStatut',['id'=>$commande->id])}}" method="post">
                                        <select name="statut" onchange="this.form.submit()" class="select">
                                            <option value="envoye" selected>Envoyé</option>
                                            <option  value="traitement">En traitement</option>
                                            <option value="pret">Prêt</option>
                                            <option value="recupere">Récupéré</option>
                                                                                                        
                                        </select>
                                        @csrf
                                            
                                    </form>
                                    <div class="arrowSelectContainer">
                                        <div  class="arrowSelectContent">
                                        <i class="material-icons">expand_more</i>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            
                            
                            <td>{{date('d.m.Y', strtotime($commande->created_at))}}</td>
                            @php $total=0 @endphp

                            @foreach ($commande->pizzas as $pizza)
                                @php $total += $pizza->prix * $pizza->pivot->qte @endphp
                            @endforeach
                            <td>{{$total}} €</td>

                            <td><a href="{{route('detailCommande',['cid'=>$commande->id,'uid'=>$commande->user_id])}}"><button class="tableCommandeDetail">Détails</button></a></td>
                        </tr>
                        
                    @endforeach
                    </tbody>
                </table>
                <div class="test">
                    {{$commandes->links('pagination.pagination-linkPizza')}}
                </div> 
            
        </div>
    </div>
</div>
@endsection