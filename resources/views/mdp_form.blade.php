<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="{{route('mdp_changer',["id"=>Auth::user()->login])}}" method="post">
        MDP: <input type="text" name="mdpNew">
        MDP Confirmation: <input type="password" name="mdpNew_confirmation">
        <input type="submit" value="Envoyer">
        @csrf
</form>
</body>
</html>