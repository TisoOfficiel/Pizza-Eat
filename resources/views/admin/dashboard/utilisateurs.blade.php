@extends('layout.app')

@section ('linkCSS','/css/dashboard/dashboardUser.css')
@section ('linkCSS1','/css/menu_vertical.css')
@section ('linkCSS2','/css/dashboard/dashboard_nav_bar.css')
@section ('linkCSS3','/css/dashboard/dashboardNavVertical.css')

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
            <a href="#"class="sidenavlist">Changer de compte</a>
        </div>  

        <div class="sidenavdeconnexion">
            <i class="material-icons">logout</i>   
            <a href="{{route('logout')}}"class="sidenavlist">Déconnexion</a>
        </div>
    </div>
</div>

<div class="dashboardUserListe">
    <div id="dashboardMenu" class="dashboardMenu">
        <div class="dashboardMenuLinkContainer">
            <div class="dashboardMenureduce" onclick="dashboardMenureduce()">
                <div class="dashboardMenureduceIcon" >

                    <i id="dashboardMenureduceIcon"class="material-icons nav_vertical_icon" >menu_open</i>
                </div>
            </div>
            <div class="dashboardMenuContent">
                    
                <a href="{{route('dashboard')}}">
                    <div class="dashboardMenuLink">
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
                    <div class="dashboardMenuLink ">
                        <i class="material-icons nav_vertical_icon">shopping_bag</i>
                        <div class="dashboardMenuLinkText">Pizzas</div>
                    </div>
                </a>
                <a href="{{route('dashboardUser')}}">
                    <div class="dashboardMenuLink active">
                        <i class="material-icons nav_vertical_icon">group</i>
                        <div class="dashboardMenuLinkText">Utilisateurs</div>
                    </div>
                </a>
            </div>
        </div>  
    </div>




    <div class="dashboardUserListeContainer">

        <!-- Header -->
        <div class="userlisteHeader">
            <h1 class="userListeHeaderTitle">Liste d'utilisateurs</h1>
        </div>
        <div class="separation"></div>
        <!-- Body -->

        <div class="userListeBodyContainer">
        
            <div class="userListeContainer">
                <div class="userListeContent">


                    <div class="userListeContentHeader">

                        <div class="userListeContentFilter">
                            @switch($roleactif)

                                    @case("All")

                                        <form action="{{route('dashboardUserfilter')}}" method="post">

                                            <input type="submit" id="Alluserfilter" name="role" value="Voir Tout" class="userListefilter userfilteractif" >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="userfilter" name="role" value="Utilisateur" class="userListefilter" >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="cookuserfilter" name="role" value="Cuisinier" class="userListefilter" >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="adminuserfilter" name="role" value="Admin" class="userListefilter">
                                            @csrf
                                        </form>
                                    @break
                                    
                                    @case("user")
                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="Alluserfilter"  name="role" value="Voir Tout" class="userListefilter " >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="userfilter" name="role" value="Utilisateur" class="userListefilter userfilteractif" >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="cookuserfilter" name="role" value="Cuisinier" class="userListefilter" >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="adminuserfilter" name="role" value="Admin" class="userListefilter">
                                            @csrf
                                        </form>
                                    @break

                                    @case("cook")
                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="Alluserfilter" name="role" value="Voir Tout" class="userListefilter " >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="userfilter" name="role" value="Utilisateur" class="userListefilter " >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="cookuserfilter" name="role" value="Cuisinier" class="userListefilter userfilteractif" >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="adminuserfilter" name="role" value="Admin" class="userListefilter">
                                            @csrf
                                        </form>
                                    @break

                                    @case("admin")
                                    <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="Alluserfilter" name="role" value="Voir Tout" class="userListefilter " >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="userfilter" name="role" value="Utilisateur" class="userListefilter " >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="cookuserfilter" name="role" value="Cuisinier" class="userListefilter " >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="adminuserfilter" name="role" value="Admin" class="userListefilter userfilteractif">
                                            @csrf
                                        </form>
                                    @break


                                    @default
                                       
                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="Alluserfilter" name="role" value="Voir Tout" class="userListefilter userfilteractif" >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="userfilter" name="role" value="Utilisateur" class="userListefilter" >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="cookuserfilter" name="role" value="Cuisinier" class="userListefilter" >
                                            @csrf
                                        </form>

                                        <form action="{{route('dashboardUserfilter')}}" method="post">
                                            <input type="submit" id="adminuserfilter" name="role" value="Admin" class="userListefilter">
                                            @csrf
                                        </form>

                                    @break
                            @endswitch
                            
                        </div>

                        <div class="addUserContainer">
                            <button onclick="openModalAddUser()"class="btnAddmember">Ajouter un membre</button>
                        </div>

                    </div>

                        <div class="userlistContainerBody">

                            @forelse ($utilisateurs as $utilisateur)
                                <div class="userListContentContainer">
                            
                                    <div class="userListeID">
                                        <p>#{{$utilisateur->id}}</p>
                                    </div>
                                    <div class="userListInfo">
                                        <div class="userListeInfoImg"><i class="material-icons">person</i></div>
                                        <div class="userListeInfoNom">
                                            <p>{{$utilisateur->nom}} {{$utilisateur->prenom}}</p>
                                        </div>
                                    </div>
                                    <div class="userListInfoLogin">
                                        <p>@ {{$utilisateur->login}}</p>
                                    </div>
                                    <div class="userListTypeContainer">
                                        @switch ($utilisateur->type)

                                            @case('user')
                                            <div class="userListTypeContent userrole">
                                                    <p>{{$utilisateur->type}}</p>
                                            </div>
                                            @break

                                            @case('cook')
                                            <div class="userListTypeContent cookrole">
                                                    <p>{{$utilisateur->type}}</p>
                                            </div>
                                            @break

                                            @case ('admin')
                                            <div class="userListTypeContent adminrole">
                                                    <p>{{$utilisateur->type}}</p>
                                            </div>
                                            @break
                                        @endswitch
                                    </div>
                                    
                                    <div class="selectContainer">
                                        <div class="selectContent">
                                            <form action="{{route('udpateRole',['id'=>$utilisateur->id])}}" method="post">
                                                <select name="role" onchange="this.form.submit()" class="select">
                                                    @switch($utilisateur->type)
                                                        @case("admin")
                                                        <option selected value="admin">Admin</option>
                                                        <option value="cook">Cuisinier</option>
                                                        <option value="user">User</option>
                                                        @break
                                                
                                                        @case("cook")
                                                        <option value="admin">admin</option>
                                                        <option value="cook"selected>Cuisinier</option>
                                                        <option value="user">User</option>
                                                        @break

                                                        @case("user")
                                                        <option value="admin">admin</option>
                                                        <option value="cook">Cuisinier</option>
                                                        <option value="user" selected>User</option>
                                                        @break
                                                    @endswitch
                                                
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
                                
                                    
                                    <div  id="userListmoreOption" data_id="userListmoreOption"class="userListmoreOption" onclick="opendropdownmenuserliste('{{$utilisateur->id}}')">
                                        <i class="material-icons pizzaListMoreOptionLinkIcon">more_horiz</i>

                                        <div id="{{$utilisateur->id}}" class="userListeDropdown">
                                            
                                            <div class="userlisteDropdownContent">

                                                <a href="{{route('editmemberview',['id'=>$utilisateur->id])}}">
                                                    <div class="userlisteDropdownContentedit">
                                                        <i class="material-icons">edit</i>
                                                        <p>Modifier</p>
                                                    </div>
                                                </a>

                                                <a href="{{route('removemember',['id'=>$utilisateur->id])}}" class="remove">
                                                    <div class="userlisteDropdownContentremove">
                                                        <i class="material-icons">delete</i>
                                                        <p>Supprimer</p>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>



                                    </div>
                                </div>
                            @empty
                                <div class="NoUserListe">
                                    <p>Il n'y a pas d'utilisateurs</p>
                                </div>
                                @for($i=1;$i < 7;$i++)
                                    <div class="userListContentContainer">
                                    
                                        <div class="userListeID">
                                            <p># {{$i}}</p>
                                        </div>
                                        <div class="userListInfo">
                                            <div class="userListeInfoImg"><i class="material-icons">person</i></div>
                                            <div class="userListeInfoNom">
                                                <p>NULL</p>
                                            </div>
                                        </div>
                                        <div class="userListInfoLogin">
                                            <p>@ NULL</p>
                                        </div>
                                        <div class="userListTypeContainer">
                                            <p>NULL</p>
                                        </div>
                                    
                                        <div class="selectContainer">
                                            
                                            <p>NULL</p>
                                        
                                        </div>
                                
                                        <div class="pizzaListMoreOption" >
                                        <i class="material-icons pizzaListMoreOptionLinkIcon">more_horiz</i>
                                        </div>
                                    </div>
                                @endfor
                            @endforelse

                    </div>
                    
                
                
                <div class="test">
                    {{$utilisateurs->links('pagination.pagination-linkPizza')}}
                </div>
            </div>

        </div>


        
    </div>
</div>


<div id="modalUserListe" class="modalUserListe" >
    <div id="containerAddModalUserListe" class="containerAddModalUserListe">
        
        <div class="modalUserListeAddheader">

            <div class="close" onclick="closeModalUserListeadd()">
                <i class="material-icons closeIcon">close</i>
            </div>

        </div>

        <form action="{{route('addMember')}}" method="POST">
                
            <div class="formContentInfo">
               
                <input id="nom" type="text" name="nom" value="{{old('nom')}}" placeholder="Nom">
                <input id="prenom" type="text" name="prenom" value="{{old('prenom')}}" placeholder="Prénom">
                
            </div>

            <div class="formContentInfo">
                
                <input id="login" type="text" name="login" value="{{old('login')}}" placeholder="Login">
                
                <select name="roleuser" id="roleuser">
                    <option value="user" selected>Utilisateur</option>
                    <option value="cook">Cuisinier</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
                
            <div class="formContent mdp">
               
                <input type="password" name="mdp" id="mdpRegister" placeholder="Mot de passe">
                <i id="passwordNotVisble"class="material-icons passwordNotVisble" onclick="visiblemdpregister()">visibility_off</i>
                
            </div>

            <div class="formContent mdp">
                <input type="password" name="mdp_confirmation" id="mdpRegisterConfirmation" placeholder="Confirmation de mot de passe">
            </div>    
                
            
            <div class="formContentSubmit">
                <input type="submit" value="Créer le membre" class="btn">
            </div>
            @csrf
        </form>

    </div>
</div>
@endsection