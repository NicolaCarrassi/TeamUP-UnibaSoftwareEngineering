<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TeamUP') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/applayout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">

    <style>
        .circle:before {
            content: ' \25CF';
            font-size: 35px;
            color: #f8b323;
        }

        .button{
            color: #ffffff;
            background-color: #f8b323;
            border-color: #f8b323;
        }

        .button:hover{
            background-color: #df9700;
            border-color: #df9700;
            border-color: #f8b323;
            color: #ffffff;
        }
    </style>

    <link rel="stylesheet" href="{{asset('css/sidebar/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar/animate.css')}}">

    <link rel="stylesheet" href="{{asset('css/sidebar/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('css/sidebar/aos.css')}}">

    <link rel="stylesheet" href="{{asset('css/sidebar/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/sidebar/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar/jquery.timepicker.css')}}">


    <link rel="stylesheet" href="{{asset('css/sidebar/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar/icomoon.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/checkboxstyle.css')}}">

    <!-- Contenuto che permette di aggiungere stili alle pagine che estendono la view app -->
    @yield('styles')

</head>
<body>

<!-- Sezione dedicata agli elementi css che deveono essere caricate dalle pagine che derivano da questa -->
@yield('css')
<div id="app">
    <div class="cc">
        <nav class="navbar navbar-expand-lg navbar-light position-fixed">


            <a class="navbar-brand" href="{{ url('/') }}">
                TeamUp
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent" >

                <ul class="navbar-nav ml-auto">

                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ $admin->email }} <span class="caret"></span>
                    </a>


                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">


                        <a class="dropdown-item" href="{{ route('adminlogin') }}">
                            {{ __('Logout') }}
                        </a>
                    </div>
                </ul>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <aside id="colorlib-aside" role="complementary" class="js-fullheight text-center" style="background-color: #353132; z-index: 0">
            <img class="img-responsive" alt="Immagine profilo utente"
                 style="width: 100%; height: 20%; margin-right: 10px;" src="{{asset('/images/app/TeamUp.png')}}">
            <h4 class="mt-3 text-white">{{$admin->email}}</h4>
            <div id="colorlib-main-menu" role="navigation" style="margin-top: 50px;">
                <ul>
                    <li><a href="{{route('adminhome',$admin->id)}}">Home</a></li>
                    <li><a href="{{route('adminreports',$admin->id)}}">Visualizza tutte le segnalazioni</a></li>
                    <li><a href="{{route('adminprojects',$admin->id)}}">Visualizza tutti i progetti</a></li>
                    <li><a href="{{route('adminideas',$admin->id)}}">Visualizza tutte le idee</a></li>
                    <li id="altro"><a href="#"><button id="altrobtn" class="btn dropdown-toggle text-white" data-toggle="dropdown" onclick="showHiddenButton()"><strong>Altro</strong></button></a></li>
                    <li id="altrecompetenze" hidden="true" style="font-size: 15px;"><a href="{{route('aggiungiCompetenze',$admin->id)}}">Approva altre competenze</a></li>
                    <li id="addadmin" hidden="true" style="font-size: 15px;"><a href="{{route('regadmin')}}">Aggiungi admin</a></li>
                </ul>
            </div>
        </aside>
    </div>

<main>
    <!-- Sezione dedicata al contenuto delle pagine che derivano da questa -->
    @yield('content')
</main>
<!-- Componente del footer personalizzato inserito da noi, con i relativi link di collegamento -->
<div class="row" style="width: 100%; margin-top: 100vh;">
    <div class="footer-basic mt-0" style="width: 100%;">
        <footer class="text-right">
            <ul class="list-inline align-center">
                <li class="list-inline-item"><a href="{{route('chiSiamo')}}">Chi siamo</a></li>
                <li class="list-inline-item"><a href="{{route('regole')}}">Regole d'utilizzo</a></li>
                <li class="list-inline-item"><a href="{{ route('terms') }}">Termini d'utilizzo</a></li>
                <li class="list-inline-item"></li>
                <img src="{{asset('/images/app/logo.png')}}" style="width: 200px;" alt="">
            </ul>
            <p class="copyright">TeamUp - FullStackException © 2020</p>
        </footer>
    </div>
</div>
</div>

<!-- sezione degli script presenti in tutte le pagine -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/script.min.js')}}"></script>
<script src="{{asset('js/applayout.js')}}"></script>
<script src="{{asset('js/scriptAdmin.js')}}"></script>
@yield('scripts')

</body>
</html>
