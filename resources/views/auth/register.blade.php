@extends('layout.app')

@section('title','Connextion')

@section ('linkCSS','/css/login_register/register.css')

@section('content')

<section>

    <div class="formContainer">
        <h1>S'enregistrer</h1>
        <!-- Formulaire d'enregistrement -->
        <form action="{{route('register')}}" method="post">
                
            <div class="formContent">
               
                <input id="login" type="text" name="login" value="{{old('login')}}" placeholder="Login">
            </div>
            
            <div class="formContentInfo">
               
                <input id="nom" type="text" name="nom"value="{{old('nom')}}" placeholder="Nom">
                <input id="prenom" type="text" name="prenom" value="{{old('prenom')}}" placeholder="Prénom">
                
            </div>
                
            <div class="formContent mdp">
               
                <input type="password" name="mdp" id="mdpRegister" placeholder="Mot de passe">
                <i id="passwordNotVisble"class="material-icons passwordNotVisble" onclick="visiblemdpregister()">visibility_off</i>
            </div>

            <div class="formContent mdp">
                <input type="password" name="mdp_confirmation" id="mdpRegisterConfirmation" placeholder="Confirmation de mot de passe">
                
            </div>    
                
            
            <div class="formContentSubmit">
                <input type="submit" value="S'enregistrer" class="btn">
            </div>
            @csrf
        </form>
        <div class="pasCompte">
            <p>Déja un compte ? <a href="{{route('login')}}">Se connecter</a></p>
        </div>
        
        <div class="otherConnexion">
            <a href="#">
                <div class="Google">
                    <img src="https://img.icons8.com/color/24/000000/google-logo.png"/>
                    <p>Google</p>
                </div>
            </a>
            <a href="#">
                <div class="Facebook">
                <img src="https://img.icons8.com/fluency/24/000000/facebook.png"/>
                    <p>Facebook</p>
                </div>
            </a>
        

        </div>
        

    </div>
</section>

@endsection