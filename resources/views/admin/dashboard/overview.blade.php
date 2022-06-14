@extends('layout.app')

@section('title','Dashboard')

@section ('linkCSS','/css/dashboard/dashboard.css')
@section ('linkCSS1','/css/menu_vertical.css')
@section ('linkCSS2','/css/dashboard/dashboard_nav_bar.css')
@section ('linkCSS3','/css/dashboard/dashboardNavVertical.css')
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
        <i id="adminIcon" class="material-icons">verified</i>
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
            <a href=""class="sidenavlist">Changer de compte</a>
        </div>  

        <div class="sidenavdeconnexion">
            <i class="material-icons">logout</i>   
            <a href="{{route('logout')}}"class="sidenavlist">Déconnexion</a>
        </div>
    </div>
</div>

<div>

</div>

<div class="dashboardContainer">
<div id="dashboardMenu" class="dashboardMenu">
        <div class="dashboardMenuLinkContainer">
            <div class="dashboardMenureduce" onclick="dashboardMenureduce()">
                <div class="dashboardMenureduceIcon" >

                    <i id="dashboardMenureduceIcon"class="material-icons nav_vertical_icon" >menu_open</i>
                </div>
            </div>
            <div class="dashboardMenuContent">
               
                <a href="{{route('dashboard')}}">
                    <div class="dashboardMenuLink active" >
                    <i class="material-icons nav_vertical_icon">dashboard</i>
                    <div class="dashboardMenuLinkText">Dashboard</div>
                    </div>
                </a>
                <a href="{{route('commandeListe')}}">
                    <div class="dashboardMenuLink">
                        <i class="material-icons nav_vertical_icon">local_shipping</i>
                        <div class="dashboardMenuLinkText">Commandes</div>
                    </div>
                </a>
                <a href="{{route('dashboardPizza')}}">
                    <div class="dashboardMenuLink">
                        <i class="material-icons nav_vertical_icon">shopping_bag</i>
                        <div class="dashboardMenuLinkText">Pizzas</div>
                    </div>
                </a>
                <a href="{{route('dashboardUser')}}">
                    <div class="dashboardMenuLink">
                        <i class="material-icons nav_vertical_icon">group</i>
                        <div class="dashboardMenuLinkText">Utilisateurs</div>
                    </div>
                </a>
            </div>
        </div>  
    </div>

    <div class="dashboardContent">

        <div class="tabcontent">
                
                <!-- HEADER -->
                <h1><span class="handIcon">👋</span>Bonjour, {{Auth::user()->prenom}} !</h1>
                <div class="separation"></div>
                
                <!-- Les widget top -->
                <div class="widgetTop">
                    
                @php $recette = 0 @endphp

                    @foreach($commandedujour as $commande)
                        @foreach ($commande->pizzas as $pizza)
                                    @php $recette += $pizza->prix @endphp
                        @endforeach

                    @endforeach
                    <div class="recette">
                        <div class="recetteContent">
                            <p class="recetteTitle">Recette du jour</p>
                            <p class="recetteValue">{{$recette}} €</p>
                        </div>
                        <div class="recetteIconContainer">
                            <i class="material-icons iconrecette">credit_card</i>
                        </div>
                    </div>


                    <div class="nbUser">
                        <div class="nbUserContent">
                            <p class="nbUserTitle">Total d'utilisateurs</p>
                            <p class="nbUserNumber">{{$usercount}}</p>
                        </div>
                        <div class="nbUserIconContainer">
                            <i class="material-icons iconNbUser">group</i>
                        </div>
                    </div>

                    <div class="nbCommande">
                        <div class="nbCommandeContent">
                            <p class="nbCommandeTitle">Total de commandes</p>
                            <p class="nbCommandeValue">{{$countcommande}}</p>
                        </div>
                        <div class="nbCommandeIconContainer">
                            <i class="material-icons iconNbCommande">local_shipping</i>
                        </div>
                    </div>

                    <div class="nbPizza">
                        <div class="pizzaContent">
                            <p class="pizzaTitle">Total pizzas</p>
                           
                            <p class="pizzaNumber">{{$countpizzas}}</p>
                        </div>
                        <div class="pizzaIconContainer">
                            <i class="material-icons iconPizza">local_pizza</i>
                        </div>
                    </div>
                </div>
                
                <!-- Widget body -->
                <div class="widgetBody">
                    <div class="tableCommandeContainer">

                        @forelse($commandes as $commande)
                        
                        @if ($loop->first)
                        <table class="tableCommandeContent">
                            <div class="tableCommandeHeader">
                                <p class="tableCommandeTitle">Commande récentes</p> 
                            </div>
                
                         @endif
                                    <tr class="tableCommandeligne">
                                        <td class="Text-Start">#{{$commande->id}}</td>
                                        <td>{{$commande->id}}</td>
                                    
                                        <td>{{$commande->user->nom}}</td>
                                        <td>#{{$commande->id}}</td>
                                        <td>{{$commande->statut}}</td>
                                        <td>{{date('d.m.Y', strtotime($commande->created_at))}}</td>
                                        <td>
                                            <a href="" class="tableCommandeDetail">Detail</a>
                                        </td>
                                    </tr>
                       @if($loop->last)
                           
            
                        </table>
                        @endif

                        @empty
                            <!-- Si pas de commande  -->
                            <div class="NoCommandeContainer">
                                <p>Aucune commande effectuer.</p>        
                            </div>
                            <table class="tableCommandeContent">
                                <div class="tableCommandeHeader">
                                    <p class="tableCommandeTitle">Commande récentes</p> 
                                </div>
                               
                              
                                @for ($i = 1; $i < 8; $i++)
                                    <tr class="tableCommandeligne">
                                        <td class="Text-Start">??</td>
                                        <td>Null</td>
                                        <td>Null</td>
                                        <td>Null</td>
                                        <td>Null</td>
                                        <td>NULL</td>
                                        <td>
                                            <a href="" class="tableCommandeDetail">Detail</a>
                                        </td>
                                    </tr>
                                @endfor
                            </table>
                        @endforelse
                    </div>

                    <div class="recentUserContainer">
                        <div class="recentUserHeader">
                            <p class="recentUserTitle">Utilisateurs récents</p>
                            <a href="{{route('dashboardUser')}}" class="recentUserlink">Voir tout</a>
                        </div>
                        @foreach ($usersrecent as $user)
                        <div class="recentUserContent">
                            <div class="userIconProfile">
                                <i class="material-icons recentIconUser">person</i>
                            </div>

                            <div class="UserProfileContent">
                                <p class="recentUserInfo">{{$user->nom}} {{$user->prenom}}</p>
                                @switch ($user->type)
                                    @case('admin')
                                        <p class="recentUserRoleAdmin">{{$user->type}}</p>
                                    @break
                                    @case('cook')
                                        <p class="recentUserRoleCook">{{$user->type}}</p>
                                    @break

                                    @case('user')
                                        <p class="recentUserRoleUser">{{$user->type}}</p>
                                    @break
                                @endswitch
                                
                            </div>
                            <a href="{{route('editmemberview',['id'=>$user->id])}}">
                            <div class="userIconMoreInfo">
                                <i class="material-icons">more_vert</i>
                            </div></a>
                        </div>
                        @endforeach
                    </div>
                </div>
                
        </div>
    </div>
</div>
@endsection