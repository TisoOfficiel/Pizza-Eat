@extends('layout.app')

@section('title','Carte- PIZZA')
@section('linkCSS','/css/menu_nav_bar.css')
@section('linkCSS1','/css/content_Container.css')
@section('linkCSS2','/css/panier.css')
@section ('linkCSS3','/css/menu_vertical.css')
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

    <!-- Affichage pour du lien se connecter pour les personnes non connecter -->
    @guest
    <div class="signIn">
        <a href="{{route('login')}}">Se connecter</a>
    </div>
    @endguest
    
</div>

<div class="contentContainer">

    <div class="filtre">
        <label for="TopVente"><input type="checkbox" name="" id="TopVente" >Top vente</label>
    </div>
<!-- Pizza -->
    <div class="bodyContainer">


        @forelse($pizzas as $pizza)
            @if ($loop->first)

                <div class="pizzaContainer">
                
                    @endif
                
                    <div class="pizzaContent">
                        <div class="PizzaINFORMATION">

                            <h6>{{$pizza->nom}}</h6>
                            <h4>{{$pizza->prix}} €</h4>
                        </div>
                        <img src="storage\img_pizza\{{$pizza->id}}.png" alt="">
                        <div class="iconaddContainer" >
                    
                            <form action="{{route('panier_add',['id'=>$pizza->id])}}" method="post">
                                @csrf

                                @if(session('panier'))
                                    @foreach(session('panier') as $pizzapanier)
                                        @if( $pizzapanier['id'] == $pizza->id)    
                                            @if($pizzapanier['quantite']>1)
                                            <button class="removeshoppingCartButton" type="submit" name="statue" value="remove" onclick="this.form.submit()"><i class="material-icons" >remove</i></button>

                                            @else
                                            <button class="removeshoppingCartButton" type="submit" name="statue" data_value ="false" value="remove" onclick="this.form.submit()"><i class="material-icons" >delete</i></button>

                                            @endif
                                            
                                            <p class="numberquantite">{{$pizzapanier['quantite']}}</p>
                                        @endif
                                    
                                        @endforeach
                                @endif

                                <button class="addshoppingCartButton" type="submit" name="statue" value="add" onclick="this.form.submit()"><i class="material-icons" >add</i></button>
                                
                            </form>
                            
                        </div>
                    </div>

            @if($loop->last)
                </div>
            
            @endif
            

            @empty

                <p>Désolé... toutes nos pizzas sont en rupture de stock repasser plus tards.</p>

        @endforelse
    
        <div class="testpaginate">
            {{$pizzas->links('pagination.pagination-linkPizza')}}
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

@endsection