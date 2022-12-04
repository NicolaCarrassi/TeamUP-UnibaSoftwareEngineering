@extends('layouts.app')

@section('content')
    <!-- Start: best carousel slide -->
    @if($datediff_report<0 || $is_banned)
        <div class="col" style="width: 50%; margin-left: 39%;">
            <img class="img-responsive" alt="Immagine profilo utente"
                 style="width: 320px; height: 220px; margin-right: 10px;" src="{{asset('/images/app/logo.png')}}">
        </div>
        <div class="row" style="width: 100%;">
            @if($is_banned)
                <h1 style="margin-left: 41%;">Sei stato bannato!</h1>
            @else
                <h1 style="margin-left: 34%;">La segnalazione è ancora in corso</h1>
            @endif
        </div>
        <a class="btn" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();" style="margin-top: 2%; margin-left: 45%;">
            <button class="btn text-white font-weight-bold btn-danger" style="width: 100px;">
                Esci
            </button>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @else
        <section id="carousel">
            <!-- Start: Carousel Hero -->
            <div class="carousel slide" data-ride="carousel" id="carousel-1">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item">
                        <div class="jumbotron pulse animated hero-nature carousel-hero">
                            <h1 class="hero-title">TeamUp</h1>
                            <p class="hero-subtitle">Benvenuto nella piattaforma che permette di trasformare le tue idee in realtà</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="jumbotron pulse animated hero-photography carousel-hero">
                            <h1 class="hero-title">Community</h1>
                            <p class="hero-subtitle">Conosci ed incontra team con i tuoi stessi interessi</p>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <div class="jumbotron pulse animated hero-technology carousel-hero">
                            <h1 class="hero-title">Non abbandonare le tue idee!</h1>
                            <p class="hero-subtitle">Realizzale con TeamUp</p>
                        </div>
                    </div>
                </div>
                <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev"><i class="fa fa-chevron-left"></i><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next"><em class="fa fa-chevron-right"></em><span class="sr-only">Next</span></a></div>
                <ol
                    class="carousel-indicators">
                    <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-1" data-slide-to="1"></li>
                    <li data-target="#carousel-1" data-slide-to="2"></li>
                </ol>
            </div>
            <!-- End: Carousel Hero -->
        </section>
        <!-- Start: Animated Type Heading -->
        <div class="caption v-middle text-center mt-2">
            <h1 class="cd-headline clip">
                <span class="blc">Io sono | </span>
                <span class="cd-words-wrapper">
                              <b class="is-visible">TeamUp</b>
                              <b>Leader</b>
                              <b>Teammate</b>
                            </span>
            </h1>
        </div>
        <!-- End: Animated Type Heading -->
        <!-- Start: --mp--Animated Service Box -->
        <section>
            <div class="container mt-lg-5 mb-lg-4-">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="serviceBox">
                            <div class="service-icon"><span><i class="fa fa-eye"></i></span></div>
                            <h1 class="titleBlurb"><a href="{{route('progattivi')}}" style="text-decoration: black">Vedi le idee</a></h1>
                            <p>Visualizza tutte le idee e i progetti a cui stiai partecipando</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="serviceBox pink">
                            <div class="service-icon"><span><i class="fa fa-exclamation"></i></span></div>
                            <h1 class="titleBlurb"><a href="{{route('createProjectualIdea')}}" style="text-decoration: black">Proponi la tua idea</a></h1>
                            <p>Non essere timoroso, proponi la tua idea e trova persone disposte a collaborare con te</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="serviceBox blue">
                            <div class="service-icon"><span><i class="fa fa-handshake-o"></i></span></div>
                            <h1 class="titleBlurb"><a href="{{route('searchPane')}}" style="text-decoration: black"> Partecipa ad un'idea </a> </h1>
                            <p>Sfrutta il tuo talento e collabora con altre persone, l'unione fa la forza e lavorando tutti insieme potrete portare a termine grandi traguardi</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection



@section('styles')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css?h=83f20576c0345c1db382e3ba2dce42f6')}}">
    <link rel="stylesheet" href="{{asset('/fonts/font-awesome.min.css?h=18313f04cea0e078412a028c5361bd4e')}}">
    <link rel="stylesheet" href="{{asset('/css/best-carousel-slide.css?h=894775746b81faa0596f6e86544b18fe')}}">
    <link rel="stylesheet" href="{{asset('/css/styles.css?h=d41d8cd98f00b204e9800998ecf8427e')}}">
    <link rel="stylesheet" href="{{asset('/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/--mp--Animated-Service-Box-1.css')}}">
    <link rel="stylesheet" href="{{asset('/css/--mp--Animated-Service-Box.css')}}">
    <link rel="stylesheet" href="{{asset('/css/Animated-Type-Heading.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css">
    <link rel="stylesheet" href="{{asset('/css/styles.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">



@endsection

@section('scripts')
    <!-- sezione degli script -->
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/js/homePage/script.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            window.addEventListener('load',function () {

                let datediff_report = '{!! $datediff_report !!}';
                let int_datediff_report = parseInt(datediff_report);

                if('{!! $is_banned !!}'==='1' || int_datediff_report<0)
                    $('#navbar').prop('hidden',true);
            });
        });
    </script>
@endsection
