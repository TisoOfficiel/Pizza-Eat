@extends('layout.app')

@section('title','Connextion')

@section ('linkCSS','/css/login_register/login.css')

@section('content')

    <section>

        <div class="formContainer">
            <h1>Se connecter</h1>
            <!-- Formulaire connextion -->
            <form action="{{route('login')}}" method="post">
                
            <div class="formContent">
                <input id="login" type="text" name="login" value="{{old('login')}}" placeholder="Login">
            </div>
                
            <div class="formContent mdp">
                <input type="password" name="mdp" id="mdpLogin" placeholder="Mot de passe">
                <i id="passwordNotVisble" class="material-icons passwordNotVisble" onclick="visiblemdplogin()">visibility_off</i>
                
            </div>
            
                
            <div class="formContent pasMotPasse">
                <a href="">Mot de passe oublier ?</a>

            </div class="formContent">
                
            <div class="formContentSubmit">
                <input type="submit" value="Se connecter" class="btn">
            </div>
            @csrf
            </form>
            <div class="pasCompte">
                <p>Pas de compte ? <a href="{{route('register')}}">Crée un compte</a></p>
            </div>
            
            <div class="otherConnexion">
                <a href="#">
                    <div class="Google">
                        <img src="https://img.icons8.com/color/24/000000/google-logo.png"/>
                        <p>Se connecter avec Google</p>
                    </div>
                </a>
                <a href="#">
                    <div class="Facebook">
                    <img src="https://img.icons8.com/fluency/24/000000/facebook.png"/>
                        <p>Se connecter avec Facebook</p>
                    </div>
                </a>
               

            </div>
            

        </div>
    </section>
@endsection



