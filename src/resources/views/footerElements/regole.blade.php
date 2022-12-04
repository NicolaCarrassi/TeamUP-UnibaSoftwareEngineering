@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/Article-List.css')}}">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <div class="article-list">
        <div class="container">
            <div class="intro">
                <h2 class="text-center" style="width: 550px;">Regole di utilizzo della piattaforma</h2>
            </div>
            <p class="text-center" style="width: 1000px;">Noi di TeamUp vogliamo che tutti i nostri utenti provino
                piacere nell'utilizzare la piattaforma, per tanto introduciamo delle regole di comportamento che i
                nostri utenti devono seguire, col fine di rendere l'esperienza d'uso indimenticabile <br><br><br></p>
            <div
                class="row articles">
                <div class="col-sm-6 col-md-4 item"><img class="img-fluid" src="{{asset('/images/app/noSpam.jpg')}}"
                                                         style="height: 300px; width: 300px" alt="">
                    <h3 class="name">È vietato lo spam</h3>
                    <p class="description">Quante volte abbiamo scartato dei siti perchè erano pieni di spam? Noi di
                        TeamUp tantissime, per tanto noi vogliamo che i nostri utenti possano godere della miglior
                        esperienza possibile, confidenti nell'attenzione dei nostri utenti
                        a segnalarci eventuali spam</p></div>
                <div class="col-sm-6 col-md-4 item"><img class="img-fluid" src="{{asset('/images/app/noSelling.png')}}"
                                                         style="height: 300px; width: 300px" alt="">
                    <h3 class="name">È vietata la vendita di prodotti</h3>
                    <p class="description">TeamUp nasce con il fine di far riunire persone aventi interessi in comune.
                        La vendita di prodotti non permette di raggiungere il nostro obiettivo, per tanto non è
                        tollerata nella nostra piattaforma</p></div>
                <div
                    class="col-sm-6 col-md-4 item"><img class="img-fluid" src="{{asset('/images/app/noExplicit.jpg')}}"
                                                        style="height: 300px; width: 300px" alt="">
                    <h3 class="name">È vietato postare contenuti espliciti</h3>
                    <p class="description">Per rendere piacevole l'utilizzo della piattaforma e la pacifica convivenza
                        dei nostri utenti, in TeamUp non sono tollerati contenuti che riguardano la violenza, contenuti
                        che possano offensivi o diffamatori verso etnie o persone e
                        materiale non conforme alla legge</p></div>
            </div>
        </div>
    </div>
@endsection
