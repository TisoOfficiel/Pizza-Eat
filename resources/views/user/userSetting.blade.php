@extends('layout.app')
@section('linkCSS','/css/menu_nav_bar.css')
@section ('linkCSS1','/css/menu_vertical.css')
@section('linkCSS2','/css/panier.css')
@section('linkCSS3','/css/user.css')
@section('content')


<div class="menuContainer">


    <div>
        <i id="menuicon" class="material-icons" onclick="openNav()"> menu</i>
    </div>

    <!-- Logo -->
    <div>
        <a href="/"><img src="/img/logo_pizza1.png" class="logo"></a>
    </div>
    
    

    <!-- bar de recherche -->
    <div class="seach_bar">
        <i class="material-icons seachicon">search</i>
        <input type="text" placeholder="4 Fromages ..." class="seach_bar_input">
    </div>
       
    <!-- Panier -->
    <div class="panierdiv" onclick="openPanier()">
        <i id="shoplogo" class="material-icons">shopping_cart</i>
        @php $totalquantite = 0 @endphp
        @if(session('panier'))
            @foreach(session('panier') as $pizza)           
                @php $totalquantite += $pizza['quantite'] @endphp
            @endforeach
            <p>Panier - {{$totalquantite}}</p>
        @else
            <p>Panier - 0</p>
        @endif     
    </div>

    <div id="panierContainer" class="panierContainer">
        
        @if(session('panier'))
       
        <div class="ItemShoppingCart"> 

            <div class="closeShoppingCart"  onclick="closePanier()">
                <i class="material-icons closeShoppingCartIcon">close</i>
            </div>
            @php $total = 0 @endphp
            <div class="ItemShoppingCartContainers">
               
                    <div class="ItemShoppingCartContent">
                       <ul>
            
                        @foreach(session('panier') as $pizza)
                            
                            @php $total += $pizza['prix'] * $pizza['quantite'] @endphp
                           
                               
                            @if($pizza['quantite']>0)
                                <li class="lv lu lt">
                                    <div class="selectContainer">
                                        <div class="selectContent">
                                        
                                            <form action="{{route('panier_add',['id'=>$pizza['id']])}}" method="post">
                                                
                                                <select name="selectquantite" class="select" onchange="this.form.submit()">
                                                    <option value="0">supprimer</option>
                                                
                                                    @for ($i = 1; $i < 99; $i++)
                                                        @if($i==$pizza['quantite'])
                                                            <option value="$pizza['quantite']" selected >{{$pizza['quantite']}}</option>

                                                        @else
                                                            <option value="{{$i}}">{{$i}}</option>
                                                        @endif
                                                    @endfor
                                                </select>
                                                @csrf
                                            </form>
                                            <div class="arrowSelectContainer">
                                                <div  class="arrowSelectContent">
                                                    <i class="material-icons">expand_more</i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ItemShoppingCartInfo">
                                        <div class="ItemInfo">
                                            {{$pizza['nom']}}
                                        </div>
                                        <div class="ItemPrix">
                                            
                                            {{ $pizza['prix'] * $pizza['quantite']}} €
                                        </div>
                                        
                                    </div>
                                    
                                </li>
                                
                            @endif

                        @endforeach
                        </ul>   
                    </div>
                    
                    <div class="r9"></div>
                    <div class="submiCommandebtn">
                    <a href="{{route('checkout')}}">Commander - {{$total}} €</a>
                    </div>
            </div>
        </div>
        @else
        <div class="noItemShoppingCart">
            <div class="closeShoppingCart" onclick="closePanier()">
                <i class="material-icons closeShoppingCartIcon">close</i>
            </div>
            <div class="noItemShoppingCartContainer">
                <i class="material-icons shoppingCartIcon">shopping_cart</i>
                <p>Ajoutez des articles pour commencer un nouveau panier.</p>
            </div>
        </div>
        @endif
        
    </div>

    
    
</div>


<div class="settingsContainer">
    <div class="settingsContent">
        <div>
            <h1>Paramètre de profile</h1>
        </div>
        <div class="settingsContentBody">
          
            <div class="profileSettingContainer">
            
                <form action="{{route('editUser',['id'=>Auth::user()->id])}}" method="post">
                    @csrf
                    <div class="profileSettingContent">
                        <label for="newNom">Nom</label>
                        <input id="newNom" name="newNom" value="{{old('newNom' , isset($newNom) ? $newNom : Auth::user()->nom )}}" type="text">
                        
                    </div>
    
                    <div class="profileSettingContent">
                        <label for="newPrenom">Prénom</label>
                        <input type="text" name="newPrenom" id="newPrenom" value="{{old('newPrenom' , isset($newPrenom) ? $newNom : Auth::user()->prenom )}}">
                    </div>
                    
                    <div class="profileSettingContent">
                        <label for="newLogin">Login</label>
                        <input id="newLogin" name="newLogin" type="text" value="{{old('newLogin' , isset($newLogin) ? $newLogin : Auth::user()->login )}}">
                    </div>
    
                    <div class="profileContentSubmit">
                        <input type="submit" value="Sauvegarder les changements" class="btnsave">
                    </div>
                </form>
                <div class="photoprofileContainer">
                    <div class="photoprofileContent">
                        <i class="material-icons">person</i>
                    </div>
                    <button><i class="material-icons">cloud_upload</i>Upload</button>
                </div>
            </div>
            <div class="separation"></div>
            <div class="cardResetremove">
                <div class="resetPassword">
                    <div class="resetPasswordInfo">
                        <h3>Mot de passe</h3>
                        
                        <p>Vous pouvez réinitialiser or changer votre mot de passe en cliquant ici</p>
                    </div>
                    <button onclick="openModalnewmdp()">Changer </button>
                </div>
                <div class="removeCount">
                    <div class="removeCountdInfo">
                        <h3>Supprimer le compte</h3>
                        <p>Une fois votre compte supprimer, il n'y a pas de route possible.</p>
                    </div>
                    <button onclick="openremoveCountp()">Supprimer</button>
                </div>
            </div>
        </div>
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
        @endauth             
                
        </div>
    </div>

<section id="modalBgChangementmdp"class="modalBgChangementmdp">


<div id="modalChangementMdp" class="modalChangementMdp" >

    <div id="modalChangementMdpContainer" class="modalChangementMdpContainer">
        
    <div class="modalmdpcloseheader">
            <div class="closeeditmdp" onclick="closeModalnewmdp()">
                <i class="material-icons closeIcon">close</i>
            </div>
    </div>

        <form action="{{route('modificationMotDePasse')}}" method="post">
            
            <div class="formContenteditmdp mdp">
                <label for="mdpActuel">Mot de passe actuel :</label>
                <input type="password" name="mdpActuel" id="mdpActuel" placeholder="Mot de passe actuel">
                
            </div>

            <div class="formContenteditmdp mdp">
                <label for="mdpNew">Nouveau mot de passe:</label>
                <input type="password" name="mdpNew" id="mdpNew" placeholder="Nouveau mot de passe">
                
            </div>
    
            <div class="formContenteditmdp mdp">
                <label for="mdpNew_confirmation">Nouveau mot de passe confirmation:</label>
                <input type="password" name="mdpNew_confirmation" id="mdpNew_confirmation" placeholder="Confirmation du mot de passe">
            </div>    
                    
            <div class="formContentSubmitNewmdp">
                <input type="submit" value="Modifier le mot de passe" class="btn">
            </div>
            @csrf
        </form>
    </div>

</div>

</section>

<section id="modalBgRemoveCount" class="modalBgRemoveCount">
    <div class="removeCounContainer">
        
            <div class="titleRemoveCountContent">
                <h3>Vous êtes sur le point de supprimer le compte êtes-vous sûr ?</h3>
            </div>
            <div class="btnCountContent">
                <button  class="btnremoveCountY"><a href="{{route('SuppressionComptePerso',['id'=>Auth::user()->id])}}">OUI<a></button>
                <button class="btnremoveCountN" onclick="closeremoveCount()">Non</button>
            </div>
     
    </div>
</section>

<div>
    @if(session()->has('etat'))
        <p>Statue {{session()->get('etat')}}</p>
    @endif
</div>
@endsection