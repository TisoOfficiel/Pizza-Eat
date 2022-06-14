@extends('layout.app')

@section('title','DashBoard Pizza')

@section ('linkCSS','/css/dashboard/dashboardPizza.css')
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




<div class="dashboardPizza">

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
                    <div class="dashboardMenuLink active">
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
    
    <div class="dashboardPizzaContainer">

            <!-- Header -->
            <div class="pizzaHeader">
                <h1 class="pizzaHeaderTitle">Catalogue de pizza</h1>
            </div>
            <div class="separation"></div>
            
            <!-- Body -->
            <div class="pizzaContainer">
                <div class="addPizzaContainer">
                    <button onclick="openModalAddpizza()"class="btnAddPizza">Ajouter une pizza</button>
                    
                        <form action="{{route('dashboardPizzaUpdate')}}" method="post">
                            <input type="date" name="dateFrom" class="calendarPizza" onchange='this.form.submit()' value="{{Request::old('dateFrom')}}">
                        @csrf
                        </form> 
                </div>
                <div class="pizzaListContainer">
                    @foreach($pizzasPaginate as $pizza)
                        <div class="pizzaListItem">
                            <div class="pizzaListInfo">
                                <div class="pizzaListInfoImg"></div>
                                <div class="pizzaListInfoNom">
                                    <p>{{$pizza->nom}}</p>
                                </div>
                            </div>
                            <div class="pizzaListDescription">
                                <p>{{$pizza->description}}</p>
                            </div>
                            <div class="pizzaListPrix">
                                <p>{{$pizza->prix}} €</p>
                            </div>
                            <div class="pizzaListDate">
                                <p>{{date('d.m.Y', strtotime($pizza->updated_at))}}</p>
                            </div>
                            
                            <div class="pizzaListMoreOption" onclick="openModalEditpizza('{{$pizza->id}}','{{$pizza->nom}}','{{$pizza->description}}','{{$pizza->prix}}')">
                                <i class="material-icons pizzaListMoreOptionLinkIcon">edit</i>
                            </div>
                            <a href="{{route('removePizza',['id'=>$pizza->id])}}" style="text-decoration:none;">
                                <div class="pizzaListMoreOption">
                                    <i class="material-icons pizzaListMoreOptionLinkIcon" style="color:red">delete</i>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    
                </div>

                <div class="test">
                   {{$pizzasPaginate->links('pagination.pagination-linkPizza')}}
                </div>
            </div>
        </div>
</div>

<div id="modalPizza" class="modalPizza" >
    <div id="containerAddModalPizza" class="containerAddModalPizza">
        <div class="modalPizzaAddheader">

            <div class="close" onclick="closeModalpizza()">
                <i class="material-icons closeIcon">close</i>
            </div>
        </div>
        <form action="/admin/dashboard/pizza/add" method="post" class="FormAddModalPizza" enctype="multipart/form-data">

            <div class="formContent">
                <label for="NomPizza">Nom de la pizza</label>
                <input id="NomPizza" type="text" name="NomPizza" placeholder="Margarita" class="inputAddmodalPizza">
            </div>

            <div class="formContent">
                <label for="File">Importer une photo</label>
                <input type="file" name="fichier">
            </div>
               
           
            <div class="formContent">
                <label for="descriptionPizzaAdd">Description de la pizza</label>
                <textarea  id="descriptionPizzaAdd"  name="DescriptionPizza" placeholder="Tomate,fromage et olive" class="inputAddmodalPizza"></textarea>
            </div>

            <div class="formContent">
                <label for="PrixPizza">Prix de la pizza</label>
                <input id="PrixPizza" type="text" name="PrixPizza" placeholder="10" class="inputAddmodalPizza">
            </div>
            
            
            <div class="formContent btndiv">
                <input type="submit" value="Ajouter pizza" class="inputAddmodalPizza btn"> 
            </div>       
            
            @csrf
        </form>
    
    </div>

    <div id="containerEditModalPizza" class="containerEditModalPizza">
        <div class="modalPizzaEditheader">


            <div class="close" onclick="closeModalpizza()">
                <i class="material-icons closeIcon">close</i>
            </div>
        </div>
        <form action="" method="post" class="FormEditModalPizza" id="FormEditModalPizza" enctype="multipart/form-data">

            <div class="formContent">
                <label for="NomPizzaEdit">Nom de la pizza</label>
                <input id="NomPizzaEdit" type="text" name="NewPizzaNom" placeholder="Margarita" class="inputAddmodalPizza" >
            </div>
            
            <div class="formContent">
                <label for="File">Importer une photo</label>
                <input type="file" name="Newfichier">
            </div>
           
            <div class="formContent">
                <label for="descriptionPizzEdit">Description de la pizza</label>
                <textarea  id="descriptionPizzEdit"  name="NewPizzaDescription" placeholder="Tomate,fromage et olive" class="inputAddmodalPizza"></textarea>
            </div>

            <div class="formContent">
                <label for="PrixPizzaEdit">Prix de la pizza</label>
                <input id="PrixPizzaEdit" type="text" name="NewPrixPizza" placeholder="10" class="inputAddmodalPizza">
            </div>
            
            
            <div class="formContent btndiv">
                <input type="submit" value="Modifier" class="inputAddmodalPizza btn"> 
            </div>       
            
            @csrf
        </form>
    
    </div>
</div>
@endsection

