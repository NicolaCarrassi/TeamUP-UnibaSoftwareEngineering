@extends('profileview.profiletemp')

@section('content')
    @parent

    <div class="col" style="margin-left: 25%; width: 75%;">
        <div class="row">
            @foreach($all_requests as $request)
                @if($request->state==0)
                    <div class="card">
                        <div class="additional">
                            <div class="user-card">
                                <div class="level center">
                                    Teammate
                                </div>
                                <div class="points center">
                                    Richiesta n.{{$request->id}}
                                </div>
                            </div>
                            <div class="more-info">
                                <h1>{{$request->name}}</h1>
                                <div class="coords">
                                    <span>Inviata il: </span>
                                    <span>{{substr($request->sent_at, 0, strlen($request->sent_at)-3)}}</span>
                                </div>
                                <div class="coords">
                                    <span>Città:</span>
                                    @if($request->city==null)
                                        <span>Ignota</span>
                                    @else
                                        <span>{{$request->city}}</span>
                                    @endif
                                </div>
                                <div class="coords">
                                    <span>Stato:</span>
                                    @switch($request->state)
                                        @case(0)
                                            <span>In sospeso</span>
                                        @break
                                        @case(1)
                                            <span>Accettata</span>
                                        @break
                                        @default
                                            <span>Rifiutata</span>
                                        @break
                                    @endswitch
                                </div>
                                <div class="stats">

                                        <a href="{{route('annullaRichiesta', $request->id)}}">
                                            <button class="btn btn-danger" style="margin-left: 25%;">
                                                Annulla richiesta
                                            </button>
                                        </a>
                                </div>
                            </div>
                        </div>
                        <div class="general">
                            <h1>{{$request->name}}</h1>
                            <p>Descrizione:<br>{{$request->description}}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

@section('styles')
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
    <style>

    @import url('https://fonts.googleapis.com/css?family=Abel');

    .center {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    }
    .card {
        width: 550px;
        height: 250px;
        background: linear-gradient(#f8f8f8, #fff);
        background-color: #fff;
        box-shadow: 0 8px 16px -8px rgba(0,0,0,0.4);
        border-radius: 6px;
        overflow: hidden;
        position: relative;
        margin: 1.5rem;
    }


    .card h1 {
    text-align: center;
    }

    .card .additional {
    position: absolute;
    width: 150px;
    height: 100%;
    background: linear-gradient(#2F2A29, #353132);
    transition: width 0.4s;
    overflow: hidden;
    z-index: 2;
    }

    .card.green .additional {
    background: linear-gradient(#92bCa6, #A2CCB6);
    }


    .card:hover .additional {
    width: 100%;
    border-radius: 0 5px 5px 0;
    }

    .card .additional .user-card {
    width: 150px;
    height: 100%;
    position: relative;
    float: left;
    }

    .card .additional .user-card::after {
    content: "";
    display: block;
    position: absolute;
    top: 10%;
    right: -2px;
    height: 80%;
    border-left: 2px solid rgba(0,0,0,0.025);
    }

    .card .additional .user-card .level,
    .card .additional .user-card .points {
    top: 15%;
    color: #fff;
    text-transform: uppercase;
    font-size: 0.75em;
    font-weight: bold;
    background: rgba(0,0,0,0.15);
    padding: 0.125rem 0.75rem;
    border-radius: 100px;
    white-space: nowrap;
    }

    .card .additional .user-card .points {
    top: 85%;
    }

    .card .additional .user-card svg {
    top: 50%;
    }

    .card .additional .more-info {
    width: 300px;
    float: left;
    position: absolute;
    left: 150px;
    height: 100%;
    }

    .card .additional .more-info h1 {
    color: #fff;
    margin-bottom: 0;
    }

    .card.green .additional .more-info h1 {
    color: #224C36;
    }

    .card .additional .coords {
    margin: 0 1rem;
    color: #fff;
    font-size: 1rem;
    }

    .card.green .additional .coords {
    color: #325C46;
    }

    .card .additional .coords span + span {
    float: right;
    }

    .card .additional .stats {
    font-size: 2rem;
    display: flex;
    position: absolute;
    bottom: 1rem;
    left: 1rem;
    right: 1rem;
    top: auto;
    color: #fff;
    }

    .card.green .additional .stats {
    color: #325C46;
    }

    .card .additional .stats > div {
    flex: 1;
    text-align: center;
    }

    .card .additional .stats i {
    display: block;
    }

    .card .additional .stats div.title {
    font-size: 0.75rem;
    font-weight: bold;
    text-transform: uppercase;
    }

    .card .additional .stats div.value {
    font-size: 1.5rem;
    font-weight: bold;
    line-height: 1.5rem;
    }

    .card .additional .stats div.value.infinity {
    font-size: 2.5rem;
    }

    .card .general {
    width: 300px;
    height: 100%;
    position: absolute;
    top: 0;
    right: 0;
    z-index: 1;
    box-sizing: border-box;
    padding: 1rem;
    padding-top: 0;
    }

    .card .general .more {
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    font-size: 0.9em;
    }


    </style>
@endsection
