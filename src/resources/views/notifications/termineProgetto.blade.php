<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie-edge">
    <title>Il progetto {{$nomeProgetto}} è concluso!</title>
</head>
<body>
Caro {{$nomeTeammate}},<br>
<p> Complimenti! Non ti sei mai fermato e tu e il tuo gruppo siete riusciti a completare il progetto {{$nomeProgetto}}:<br></p>
<p> Adesso non fermarti, TeamUp è pieno di progetti interessanti in cui potrai dimostrare il tuo valore e grazie ai quali potrai fare nuove amicizie!</p>
<br><br>
<a href="{{route('home')}}"><p>Lo staff di TeamUp</p></a>
</body>
</html>
