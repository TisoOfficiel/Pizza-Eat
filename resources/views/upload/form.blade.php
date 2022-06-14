@extends('layout.app')
@section('title','File upload')
@section('content')
<form action="{{route('fupload')}}" method="post" enctype="multipart/form-data">
<input type="file" name="fichier">
<input type="submit" value="Téléverser">
@csrf
</form>
@endsection