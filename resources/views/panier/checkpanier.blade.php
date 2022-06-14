@extends('layout.app')

@section('title','Dashboard')

@section ('linkCSS','/css/menu_vertical.css')
@section ('linkCSS1','/css/dashboard/dashboard_nav_bar.css')
@section('linkCSS2','/css/commandecheckout.css')

@section('content')



<!-- Menu nav bar horizontal -->
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
                <a href="/{{Auth::user()->id}}/compteSetting">Voir le compte</a>
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
    </div>
</div>

<div class="CommandeContainerBody">
    <div class="recapInfoCommandeContainer">
        <h1>Pizza Eat (Créteil)</h1>
        <div class="livraisonContainer">
            
            <div class="livraisonLieuContainer">
                <div class="livraisonlieuContent">
                    <div class="livraisonlieuicon"><i class="material-icons">location_on</i></div>
                    <div class="livraisonlieuInfo">
                        <p class="livraisonlieuInfoAdresse">61 Av. du Général de Gaulle</p>
                        <p class="livraisonlieuInfoVille">Créteil</p>
                    </div>
                </div>
                <div class="livraisoneditContent"><button class="commandeRecapbtn">Modifer</button></div>
            </div>

            <div class="livraisonmethodeContainer">
                <div class="livraisonmethodeContent">
                    <div class="livraisonmethodeicon"><i class="material-icons">accessibility</i></div>
                    <div class="livraisonlieuInfo">
                        <p class="livraisonmethode">En main propre</p>
                        <p class="livraisonmethodinstruction">Ajouter des instructions de livraison</p>
                    </div>
                </div>
                <div class="livraisonmethiodeeditContent"><button class="commandeRecapbtn">Modifer</button></div>
            </div>

        </div>
        <hr class="separation"></hr>
        <div class="livraisondureeContainer">

            <h3 class="livraisondureeheader">
                <span>Estimation pour un repas en livraison</span>
                <div>Entre 10 et 20 min</div>
            </h3>
            
            <div class="livraisonLieuContainer">
                <div class="livraisonlieuContent">
                    <div class="livraisonlieuicon">
                        <input type="radio" name="prenium" value="true">
                    </div>
                    <div class="livraisonlieuInfo">
                        <p class="livraisonlieuInfoAdresse">Prenium</p>
                        <p class="livraisonlieuInfoVille">Livraison directement chez vous</p>
                    </div>
                </div>
                <div class="livraisoneditContent">+1.99€</div>
            </div>
            <div class="livraisonLieuContainer">
                <div class="livraisonlieuContent">
                    <div class="livraisonlieuicon">
                        <input checked type="radio" name="prenium" value="false">
                    </div>
                    <div class="livraisonlieuInfo">
                        <p class="livraisonlieuInfoAdresse">Standard</p>
                        
                    </div>
                </div>
                
            </div>
        </div>
        <hr class="separation"></hr>
        <div class="livraisondureeContainer">

            <h3 class="livraisondureeheader">
                <span>Moyen de paiement</span>
                
            </h3>
            <div class="livraisonLieuContainer">
                <div class="livraisonlieuContent">
                <div class="livraisonmethodeicon"><i class="material-icons">credit_card</i></div>
                    <div class="livraisonlieuInfo">
                        <p class="livraisonlieuInfoAdresse">Pizza Cash : 0,00€</p>
                        <p class="livraisonlieuInfoVille">+ Visa - 1234</p>
                    </div>
                </div>
                <div class="livraisoneditContent"><button class="commandeRecapbtn">Modifer</button></div>
            </div>
            <div class="livraisonLieuContainer">
                <div class="livraisonlieuContent">
                    <div class="livraisonlieuicon">
                        <i class="material-icons">sell</i>
                    </div>
                    <div class="livraisonlieuInfo">
                        <p class="livraisonlieuInfoAdresse">Ajouter un code promotionnel</p>
                    </div>
                </div>
                <div class="livraisoneditContent"><button class="commandeRecapbtn">Modifer</button></div>
            </div>
        </div>
        <hr class="separation"></hr>
        <div class="livraisondureeContainer">

            <h3 class="livraisondureeheader">
                <span>Vos articles</span>
                <div><a href="/"><button class="commandeRecapbtnAdd"><i class="material-icons">add</i>Ajouter des articles</button></a></div>
            </h3>
            @php $total=0 @endphp
            @foreach($paniers as $panier)
            @php $total += $panier['prix'] * $panier['quantite'] @endphp
            <div class="livraisonLieuContainertest">
                <div class="livraisonlieuContent">
                    <div class="livraisonlieuicon">{{$panier['quantite']}}</div>
                    <div class="livraisonlieuInfo">
                        <p class="livraisonlieuInfoAdresse">{{$panier['nom']}}</p>
                        
                    </div>
                </div>
                <div class="livraisoneditContent"><p>{{$panier['prix']}} €</p></div>
            </div>
            <div class="separation"></div>           
            @endforeach
            
        </div>
    </div>
    <div class="recapPrixCommandeContainer">
        <div class="recapPrixCommandeContent">
            <a href="{{route('Commande')}}" class="commandebtnlink"><div class="commandebtn">
                Commander
            </div></a>
            <div class="el"></div>
            <div>
                <p class="condition">
                    Contrats sur les services En cliquant sur le bouton pour passer votre commande, vous acceptez le Contrat sur les services de livraison avec Uber Eats France SAS (RCS 841 983 828)
                </p>
            </div>
            <div class="gp"></div>
            <div>
                <p class="condition">
                Vous renoncez pour rappel à votre droit de rétractation ayant pour objet les services de livraison. Vous avez la possibilité de recourir à un médiateur de la consommation ici.
                </p>
            </div>
            <div class="gp"></div>
            <div>
                <p class="condition">
                Si vous n'êtes pas là à l'arrivée du coursier, ce dernier déposera votre repas devant la porte. Lorsque vous passez une commande, vous acceptez d'en assumer l'entière responsabilité une fois celle-ci livrée.
                </p>
            </div>
            <div class="separation"></div>
            <div class="livraisondureeContainer">

            <div class="livraisoncommandepaiementheader">
                <span>Sous-total </span>
                <div>{{$total}} €</div>
            </div>
            <div class="livraisonLieuContainer">
                <div class="livraisonlieuContent">
                    <div class="livraisonlieuInfo">
                        <p class="livraisonlieuInfoAdresse">Frais <i class="material-icons">error</i></p>
                    </div>
                </div>
                
            </div>
            <div class="livraisonLieuContainer">
                <div class="livraisonlieuContent">
                    <div class="livraisonlieuInfo">
                        <p class="livraisonlieuInfoAdresse">Service <i class="material-icons"></i></p>
                    </div>
                </div>
                <div class="livraisoneditContent">Gratuit</div>
            </div>
            <div class="livraisonLieuContainer">
                <div class="livraisonlieuContent">
                    <div class="livraisonlieuInfo">
                        <p class="livraisonlieuInfoAdresse">Livraison <i class="material-icons"></i></p>
                    </div>
                </div>
                <div class="livraisoneditContent">Gratuit</div>
            </div>
            <div class="livraisonLieuContainer">
                <div class="livraisonlieuContent">
                    <div class="livraisonlieuInfo">
                        <p class="livraisonlieuInfoAdresse">Priorité <i class="material-icons"></i></p>
                    </div>
                </div>
                <div class="livraisoneditContent">Gratuit</div>
            </div>
            <div class="separation"></div>
            <div class="livraisoncommandepaiementheader">
                <span>Total</span>
                <div>{{$total}} €</div>
            </div>
        </div>
        </div>
    </div>
</div>



@endsection