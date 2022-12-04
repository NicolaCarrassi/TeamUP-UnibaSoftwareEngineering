@extends('layouts.app')

@section('content')
    <div class="container-fluid" >
        <aside id="colorlib-aside" role="complementary" class="js-fullheight text-center" style="background-color: #f8b323; z-index: 0; padding-left: 0%; padding-right: 0%;">
            @if($progetto->image !== null)
                <img class="img-responsive rounded-circle" alt="immagine idea"
                 style="width: 120px; height: 120px; margin-right: 10px; box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.5);" src="{{asset('/storage/'.$progetto->image)}}">
            @else
                <img class="img-responsive rounded-circle" alt="immagine idea"
                     style="width: 120px; height: 120px; margin-right: 10px; box-shadow: 0px 3px 6px 0px rgba(0, 0, 0, 0.5);" src="{{asset('/images/app/placeholder.png')}}">
            @endif
            <h3 class="mt-3">{{$progetto->name}}</h3>
            <div class="row mt-2 justify-content-center" style="margin: 0; background-color: #d4a017;">
                <label class="text-dark" style="font-size: 16px; margin: 0;"><strong>Partecipanti</strong></label>
            </div>
            <div class="row mt-n3 justify-content-center" style="margin: 0; background-color: #d4a017;">
                <div id="colorlib-main-menu" role="menuitemradio" style="margin-top: 25px;">
                    <ul style="margin-top: 15px;" class="text-dark">
                    @if(strlen($progetto->leader_id['leader_username']) > 15)
                        <li style="margin-top: -20px;"><strong><a href="{{route('profile', $progetto->leader_id['leader_id'])}}" class="text-white">{{substr($progetto->leader_id['leader_username'],0,15)}}...</a> -Leader</strong></li>
                    @else
                        <li style="margin-top: -20px;"><strong><a href="{{route('profile', $progetto->leader_id['leader_id'])}}" class="text-white">{{$progetto->leader_id['leader_username']}}</a> -Leader</strong></li>
                    @endif
                    @if(count($progetto->teammates) < 3)
                        @foreach($progetto->teammates as $teammate)
                            @if(strlen($teammate->username) > 15)
                                <li style="margin-top: -20px;"><strong><a href="{{route('profile', $teammate->id)}}">{{substr($teammate->username,0,15)}}...</a> -Teammate</strong></li>
                            @else
                                <li style="margin-top: -20px;"><strong><a href="{{route('profile', $teammate->id)}}">{{$teammate->username}}</a> -Teammate</strong></li>
                            @endif
                        @endforeach
                    @else
                        @for($i = 0; $i < 3; $i++)
                            @if(strlen($progetto->teammates[$i]->username) > 15)
                                <li style="margin-top: -20px;"><strong><a href="{{route('profile', $progetto->teammates[$i]->id)}}">{{substr($progetto->teammates[$i]->username,0,15)}}...</a> -Teammate</strong></li>
                            @else
                                <li style="margin-top: -20px;"><strong><a href="{{route('profile', $progetto->teammates[$i]->id)}}">{{$progetto->teammates[$i]->username}}</a> -Teammate</strong></li>
                            @endif
                        @endfor
                    @endif
                        <li style="margin-top: -20px; font-size: 10px;"><strong><a data-target="#visualizzaTuttiPartecipanti" onclick="showAllPartecipants()" data-toggle="modal" class="MainNavText" id="visualizzaTutti" href="#visualizzaTuttiPartecipanti">Visualizza tutti</a></strong></li>
                    </ul>
                </div>
            </div>
            <p class="text-dark" style="font-size: 16px;"><strong>Numero di partecipanti: {{$progetto->numberOfComponentsActual}}/{{$progetto->numberOfComponentsRequired}}</strong></p>
            @if($progetto->idea_start_at !== null)
                    <p class="text-dark" style="font-size: 16px;"><strong>Data Avvio Progetto: {{substr($progetto->idea_start_at, 0, strlen($progetto->idea_start_at)-8)}}</strong></p>
            @endif
            <div id="colorlib-main-menu" role="menuitemradio" style="margin-top: 25px;">
                <ul style="margin-top: 15px;">

                    <!-- possibilità di segnalare concessa solo se non si è partecipanti -->
                    @can('report', $progetto)
                        <li style="margin-top: -20px;"><a data-target="#partecipazioneModal" data-toggle="modal" href="#partecipazioneModal" onclick="startModal({{$progetto->id}},1, 'Request')">
                                Richiedi di partecipare
                            </a></li>
                        <li style="margin-top: -20px;"><a data-target="#segnalazioneModal" data-toggle="modal" href="#segnalazioneModal" onclick="startModal({{$progetto->id}},2, 'Idea')">
                                Segnala
                            </a></li>
                    @endcan


                    @can('update', $progetto)
                        @if($progetto->project_end_at === false)
                            <li style="margin-top: -20px;"><a data-target="#visualizzaRichieste" onclick="showAllRequests()" data-toggle="modal" class="MainNavText" id="visualizzaTutteRichieste" href="#visualizzaRichieste">Visualizza richieste partecipazione</a></li>
                        @endif

                        @if($progetto->idea_start_at === null)
                            <li style="margin-top: -20px;"><a href="{{route('startProject', $progetto->id)}}">Avvia progetto</a></li>
                            <li style="margin-top: -20px;"><a href="{{route('modifyProjectualIdea', $progetto->id)}}">Modifica idea</a></li>
                            <li style="margin-top: -20px;"><a href="{{route('deleteProjectualIdea', $progetto->id)}}">Elimina idea</a></li>
                        @elseif($progetto->project_end_at === false)
                            <li style="margin-top: -20px;"><a href="{{route('tasksAndFeeds', $progetto->id)}}">Assegna compiti</a></li>
                        @endif

                    @endcan

                    @can('view', $progetto)
                        @if($progetto->idea_start_at !== null)
                            <li style="margin-top: -20px;"><a href="{{route('tasksAndFeeds', $progetto->id)}}">Aggiornamenti progetto</a></li>
                        @endif
                        <li style="margin-top: -20px;"><a href="{{route('riepilogativePage', $progetto->id)}}">Info</a></li>
                        @if($progetto->project_end_at === false)
                            @if($progetto->idea_start_at !== null)
                                @can('update', $progetto)
                                     <li style="margin-top: -20px;"><a href="{{route('endProject', $progetto->id)}}">Termina Progetto</a></li>
                                @endcan
                            @endif
                            <li style="margin-top: -20px;"><a href="{{route('abbandona', $progetto->id)}}">Abbandona</a></li>
                        @endif
                    @endcan
                </ul>
            </div>
        </aside>
    </div>

    @can('report', $progetto)
        @include('components.partecipationRequest')
        @include('components.report')
    @endcan

    @include('idea.modalTeam', $progetto)
    @include('idea.modalRequestLeader', ['progetto'=>$progetto, 'richieste'=>$richieste])
@endsection

@section('scripts')
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/it_IT/sdk.js#xfbml=1&version=v7.0&appId=289062385606263&autoLogAppEvents=1" nonce="RWxxW4ZN"></script>

    @can('report', $progetto)
    <script src="{{asset('/js/scriptReport.js')}}"></script>
    @endcan

    @can('update',$progetto)
        @if($progetto->sponsored === 0)
            <script src="https://www.paypal.com/sdk/js?client-id=sb&currency=EUR" data-sdk-integration-source="button-factory"></script>
            <script>
                if(document.getElementById('paypal-button-container') !== null) {
                    paypal.Buttons({
                        style: {
                            size: 'small',
                            shape: 'rect',
                            color: 'gold',
                            layout: 'vertical',
                            label: 'paypal',
                        },
                        createOrder: function (data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: '3'
                                    }
                                }]
                            });
                        },
                        onApprove: function (data, actions) {
                            return actions.order.capture().then(function () {
                                alert('Transazione completata');
                                document.location.href = "{!! route('sponsor', $progetto->id); !!}";
                            });
                        }
                    }).render('#paypal-button-container');
                }
            </script>
        @endif
    @endcan

    <script src="{{asset('/js/scriptRiepilogativePage.js')}}"></script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.page-link', function(event) {
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];

                if($('#typeModalTable').prop('innerText')=='0')
                    fetch_data_tasks(page);
                else
                    fetch_data_feeds(page);
            });
        });

        function fetch_data_tasks(page) {
            $.ajax({
                url: '{!! route('taskspagination') !!}',
                method: 'POST',
                data: {_token : '{{csrf_token()}}',page : page, project_id : '{!! $progetto->id !!}'}
            }).done(function (data) {
                $('#table_data_tasks').html(data);
            });
        }

        function fetch_data_feeds(page) {
            $.ajax({
                url: '{!! route('feedspagination') !!}',
                method: 'POST',
                data: {_token : '{{csrf_token()}}',page : page, project_id : '{!! $progetto->id !!}'}
            }).done(function (data) {
                $('#table_data_feeds').html(data);
            });
        }
    </script>
@endsection

@section('styles')
    <style>
        #rectangle {
            width: 100%;
            height: 150px;
            background: #d4a017;
        }

        .circleYellow:before {
            content: ' \25CF';
            font-size: 35px;
            color: #f8b323;
        }

        .circleGreen:before {
            content: ' \25CF';
            font-size: 35px;
            color: #41A317;
        }

        .circleRed:before {
            content: ' \25CF';
            font-size: 35px;
            color: #ff0000;
        }

        .bottone-paginazione> nav{
            position: relative;
            z-index: 0;
        }

    </style>
    <link rel="stylesheet" href="{{asset('css/sidebar/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/Bootstrap-4---Table-Fixed-Header.css')}}">

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

    <meta property="og:url"           content="https://127.0.0.1:8000/idea/{{$progetto->id}}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="TeamUP" />
    <meta property="og:description"   content="Entra in TeamUp" />
    <meta property="og:image"         content="{{$progetto->image ?? $progetto->image }}"/>
@endsection
