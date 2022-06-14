@extends('layout.app')

@section('title','pagination')

@section('style')
    <style>
        .container{
            border: 1px solid black;
        }

    </style>
@endsection
@section('content')

<div class="container">
    @foreach ($users as $user)
        <p>id : {{$user->id}} nom : {{$user->nom}}</p>   
    @endforeach
</div>

{{$users->links('pagination.pagination-link')}}


<!-- <div class="recentUserContainer">
    <table class="tableUserContent">
        <p class="tableUserTitle">Utilisateurs récents</p>
        <th class="tableUserHeader">ID</th>
        <th class="tableUserHeader">Nom</th>
        <th class="tableUserHeader">Prénom</th>
        <th class="tableUserHeader">Role</th>
        @foreach ($users as $user)
            <tr class="tableUserligne">
                <td>{{$user->id}}</td>
                <td>{{$user->nom}}</td>
                <td>{{$user->prenom}}</td>
                <td>{{$user->type}}</td>
            </tr>
        @endforeach
    </table>            
</div> -->





@endsection

