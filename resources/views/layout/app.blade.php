<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="@yield('linkCSS')">    
    <link rel="stylesheet" href="@yield('linkCSS1')">    
    <link rel="stylesheet" href="@yield('linkCSS2')"> 
    <link rel="stylesheet" href="@yield('linkCSS3')"> 
       

    <!-- Link pour les icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    
    <!-- Link pour la font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background-color:#fbf5ee;
        }
    </style>
    <!-- Bootsrap -->

    
    @yield('style')
</head>
<body>
    
    @yield('content')
    <script type="text/javascript" src="{{URL::asset('/js/app.js')}}"></script>
    
</body>
</html>


