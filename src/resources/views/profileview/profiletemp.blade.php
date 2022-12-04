@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <aside id="colorlib-aside" role="complementary" class="js-fullheight text-center" style="background-color: #f8b323; z-index: 0">

            @if(Auth::user()->provider === null || strpos(Auth::user()->avatar, 'https://') === false)
                <img class="img-responsive rounded-circle" alt="Immagine profilo utente"
                     style="width: 180px; height: 180px; margin-right: 10px; box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.5);" src="{{asset('/storage/users-avatar/'.Auth::user()->avatar)}}">
            @else
                <img class="img-responsive rounded-circle" alt="Immagine profilo utente"
                     style="width: 180px; height: 180px; margin-right: 10px; box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.5);" src="{{Auth::user()->avatar}}">
            @endif
                <h2 class="mt-3">
                    @if(strlen($user->username)>=20)
                        @for($i=0;$i<(strlen($user->username)/10);$i++)
                                {{substr($user->username,10*$i,10*($i+1))}}<br>
                        @endfor
                    @else
                        {{$user->username}}
                    @endif
                </h2>
            <div id="colorlib-main-menu" role="navigation" style="margin-top: 50px;">
                <ul>
                    <li><a href="{{route('profile',$user->id)}}">Info</a></li>
                    @if($user->id==auth()->user()->getAuthIdentifier())

                        <li><a href="{{route('modprofile')}}">Modifica Profilo</a></li>
                        <li><a href="{{route('storicoprog')}}">Visualizza storico progetti</a></li>
                        <li><a href="{{route('progattivi')}}">Visualizza progetti attivi</a></li>
                        <li><a href="{{route('partecip')}}">Visualizza richieste partecipazione</a></li>
                    @else
                        <li>
                            <a onclick="startModal({{$user->id}},2,'User')" data-id="{{$user->id}}" data-toggle="modal" data-target="#segnalazioneModalUser" class="btn">
                            Segnala utente
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </aside>
    </div>
    @include('components.reportuser')
@endsection

@section('scripts')
    <script src="{{asset('/js/scriptReport.js')}}"></script>
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
@endsection
