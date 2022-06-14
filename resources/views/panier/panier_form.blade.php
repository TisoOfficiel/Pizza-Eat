@extends('layout.app')

@section('title','panier')
@section('linkCSS','css/panier.css')
@section('content')
    <ul>
    @foreach($pizzas as $pizza)
       
    <li >{{$pizza->nom}}</li>
        <form action="{{route('panier_add',['id'=>$pizza->id])}}" method="post">
            @csrf
            <input type="submit" name="statue" value="add">Ajouter</input>
            <input type="submit" name="statue" value="remove"> Enlever</input>
        </form>      
    @endforeach
    </ul>


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
                                            qte : {{ $pizza['quantite']}}
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
            <div class="closeShoppingCart">
                <i class="material-icons closeShoppingCartIcon">close</i>
            </div>
            <div class="noItemShoppingCartContainer">
                <i class="material-icons shoppingCartIcon">shopping_cart</i>
                <p>Ajoutez des articles pour commencer un nouveau panier.</p>
            </div>
        </div>
        @endif
        
    </div>
    
@endsection


