@extends('layout.app')

@section('title','Connextion')

@section ('linkCSS','/css/??')

@section('content')

    <!-- Formulaire ajout pizza -->
    <form action="/admin/pizza" method="post">
    
    <label for="NomPizza"> Nom de la pizza</label>
    <input id="NomPizza" type="text" name="NomPizza" placeholder="Pizza Marguerita">
    
    <label for="DescriptionPizza"> Description de la pizza</label>
    <input id="DescriptionPizza" type="text" name="DescriptionPizza" placeholder="Tomate,fromage et olive">
    
    <label for="PrixPizza"> Prix de la pizza</label>
    <input id="PrixPizza" type="text" name="PrixPizza" placeholder="10€">

    <input type="submit" value="Ajouter une pizza">
    @csrf
    </form>

    @forelse($pizzas as $pizza)
        @if ($loop->first)
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                </tr>
                @endif
                <tr>
                    <td>{{$pizza->id}}</td>
                    <td>{{$pizza->nom}}</td>
                    <td>{{$pizza->description}}</td>
                    <td>{{$pizza->prix}}</td>
                    
                </tr>
        @if($loop->last)
            </table>
        @endif

    @empty

        <p>Aucune Pizza ici</p>

    @endforelse

    <div><a href="{{route('logout')}}">Se deconnecter</></div>
@endsection