@extends('layout.app')


@section ('linkCSS','/css/dashboard/dashboard_nav_bar.css')
@section ('linkCSS1','/css/menu_vertical.css')
@section('linkCSS3','/css/commandeDetail.css')

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
        @guest
        <div id="mySidenav" class="sidenavguest">
            <i class="material-icons" id="closenav" onclick="closeNav()">close</i>
            <a href="{{route('login')}}" class="loginLink">
                <div class="loginContainer">
                    Se connecter
                </div>
            </a>
            <div class="registerContainer">
                <a href="{{route('registerForm')}}">Créez un compte</a>
            </div>
                
        @endguest


        @auth
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
                        </p>
                        <a href="{{route('UserSettings',['id'=>Auth::user()->id])}}">Voir le compte</a>
                    </div>

                
                </div>
                
                @if(Auth::user()->type=='admin')
                <div class="sidenavdashboard">
                    <i class="material-icons">dashboard</i>
                    <a href="{{route('dashboard')}}" class="sidenavlist">Dashboard</a>
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
        @endauth             
                
        </div>
    </div>

<div class="CommandeDetailContainer">
    <div class="CommandeDetailContent">
        <div>
            <h1>Détails de commande </h1>
        </div>
        <div class="CommandeDetailContentBody">
        
            <div class="CommandeDetailContentBodyHeader">
                <div class="headerleft">
                    <div class="headerleftop">
                        <i class="material-icons calendar">calendar_month</i>
                        <h4>{!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y', strtotime($commande->created_at))) !!}</h4>
                    </div>
                    <div class="headerlefbottom">
                        <p>Commande ID : #{{$commande->id}}</p>   
                    </div>
                </div>
                <div class="headerright">

                </div>
            </div>
            <div class="separation"></div>
            
            <div class="CommandeDetailContentOrderInfo">

                <div class="CommandeCustomerInfo">
                    <div class="CommandeDetailContentOrderInfoIcon">
                        <div class="iconContainer">
                            <i class="material-icons">person</i>
                        </div>
                    </div>

                    <div class="CommandeDetailContentOrderInfoContent">
                        <h4>Client</h4>
                        <p>Nom: {{$user->nom}}</p>
                        <p>Prénom: {{$user->prenom}}</p>
                        <p>ID : #{{$user->id}}</p>
                        
                        <!-- <a href="" class="userprofile">Voir profile</a> -->
                    </div>
                </div>

                <div class="CommandeOrderinfo">
                    <div class="CommandeDetailContentOrderInfoIcon">
                        <div class="iconContainer">
                            <i class="material-icons">local_shipping</i>
                        </div>
                    </div>
                    <div class="CommandeDetailContentOrderInfoContent">
                        <h4>Info Commande</h4>
                        <p>Expédition: Pizza Eat</p>
                        <p>Moyen de paiement</p>
                        <p>Statut : {{$commande->statut}}</p>
                    </div>
                </div>

                <div class="CommandeAdresseInfo">
                    <div class="CommandeDetailContentOrderInfoIcon">
                        <div class="iconContainer">
                            <i class="material-icons">location_on</i>
                        </div>
                    </div>
                    <div class="CommandeDetailContentOrderInfoContent">
                        <h4>Livrer à </h4>
                        <p>Ville : Créteil</p>
                        <p>Numéro Rue : 61 </p>
                        <p>Adresse: Av. du Général de Gaulle </p>
                    </div>
                </div>

            </div>

            <div class="DetailCommandeContent">
                <div class="tableRecapContainer">
                    <table>
                        <thead>
                            <tr class="listPizza">

                                <th>Pizza</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        @php $TotalCommande = 0 @endphp
                        <tbody>
                        @foreach($commande->pizzas as $pizza )
                        @php $total=0 @endphp
                            <tr class="listPizza">   
                                <td>{{$pizza->nom}}</td>
                                
                                
                                <td>{{$pizza->prix}} €</td>
                                <td>{{$pizza->pivot->qte}}</td>
                                @php $total+= $pizza->prix * $pizza->pivot->qte@endphp
                                @php $TotalCommande += $total @endphp
                                <td>{{$total}} €</td>
                            </tr>
                            
                            @endforeach
                            <tr>
                                <td colspan="4">
                                    <article class="float-end">
                                    <dl class="dlist">
                                        <dt>SubTotal: </dt>
                                        <dd>{{$TotalCommande}} €</dd>
                                    </dl>
                                    <dl class="dlist">
                                        <dt>Frais de livraison: </dt>
                                        <dd>Gratuit</dd>
                                        </dl>
                                    <dl class="dlist">
                                        <dt>Total: </dt>
                                        <dd style="font-weight:bold;font-size:24px">{{$TotalCommande}} €</dd>
                                        </dl>
                                    <dl class="dlist">
                                        <dt class="statut">Statut:</dt>
                                        <dd class="paiementstatut">
                                            <div>Paiement fait </div>
                                        </dd>
                                    </dl>
                                    </article>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="PaiementInfoCard">
                    <h4>Info de paiement </h4>
                    <div class="card">
                        <img src="/img/mastercard.png" alt="" class="mastercard">
                        <p>Master Card **** **** 1234</p>
                    </div>
                    <p> Business name: Grand Market LLC</p>
                    <p>Phone: +1 (800) 555-154-52</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection