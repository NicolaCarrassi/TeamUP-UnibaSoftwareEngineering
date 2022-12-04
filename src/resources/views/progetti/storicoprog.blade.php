@extends('profileview.profiletemp')

@section('content')
    @parent

    <div class="col" style="margin-left: 21.2%; width: 78%;">
        <nav class="navbar navbar-light navbar-expand-md">
            <div class="container-fluid">
                <button id="allprojectsbtn" class="btn navbar-brand">Tutti i progetti</button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <button id="myprojectsbtn" class="btn nav-item" role="presentation"><a class="nav-link">I miei progetti</a></button>
                    <button id="joinedprojectsbtn" class="btn nav-item" role="presentation"><a class="nav-link">Partecipazioni</a></button>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row" style="height: 100%;">
                <div class="col mx-auto bg-white rounded shadow">
                    <div class="table-responsive">
                        <div id="allprojects" class="col">
                            @if(sizeof($all_projects)===0)
                                <div class="row" style="margin-left: 5%; width: 70%;">
                                    <h1 id="bell">Non ci sono progetti terminati</h1>
                                </div>
                            @else
                                <table class="table table-fixed">
                                    <caption></caption>
                                    <thead>
                                    <tr>
                                        <th scope="col" class="col-2" style="background-color: #f8b323;">Nome Progetto</th>
                                        <th scope="col" class="col-2" style="background-color: #f8b323;">Data Inizio</th>
                                        <th scope="col" class="col-2" style="background-color: #f8b323;">Data Fine</th>
                                        <th scope="col" class="col-2" style="background-color: #f8b323;">Leader</th>
                                        <th scope="col" class="col-2" style="background-color: #f8b323;">Stato</th>
                                        <th scope="col" class="col-2" style="background-color: #f8b323;"><br></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_projects as $project)
                                        <tr>
                                            <th scope="row" class="col-2" style="width: 100%; word-wrap: break-word;">{{$project->name}}</th>
                                            <td class="col-2">{{\Carbon\Carbon::parse($project->idea_start_at)}}</td>
                                            <td class="col-2">{{\Carbon\Carbon::parse($project->end_date)}}</td>
                                            <td class="col-2" style="width: 90%; word-wrap: break-word; white-space: pre-wrap; text-overflow: ellipsis;">{{$project->username}}</td>
                                            <td class="col-2">
                                                @if($project->ended)
                                                    <img src="{{asset('images/app/true.png')}}" style="height: 24px; width: 24px; margin-left: 5%; margin-top: -4px;" alt="TrueImage">
                                                @else
                                                    <img src="{{asset('images/app/false.png')}}" style="height: 24px; width: 24px; margin-left: 5%; margin-top: -4px;" alt="FalseImage">
                                                @endif
                                            </td>
                                            <td class="col-2"><br></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div id="activeprojects" hidden="true" class="col">
                            @if(sizeof($leader_projects)===0)
                                <div class="row" style="margin-left: 5%; width: 70%;">
                                    <h1>Non ci sono progetti in cui sei leader terminati</h1>
                                </div>
                            @else
                                <table class="table table-fixed">
                                    <caption></caption>
                                    <thead>
                                    <tr>
                                        <th scope="col" class="col-3" style="background-color: #f8b323;">Nome Progetto</th>
                                        <th scope="col" class="col-3" style="background-color: #f8b323;">Data Inizio</th>
                                        <th scope="col" class="col-3" style="background-color: #f8b323;">Data Fine</th>
                                        <th scope="col" class="col-3" style="background-color: #f8b323;">Stato</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($leader_projects as $project)
                                        <tr>
                                            <th scope="row" class="col-3" style="width: 100%; word-wrap: break-word;">{{$project->name}}</th>
                                            <td class="col-3">{{\Carbon\Carbon::parse($project->idea_start_at)}}</td>
                                            <td class="col-3">{{\Carbon\Carbon::parse($project->end_date)}}</td>
                                            <td class="col-3">
                                                @if($project->ended)
                                                    <img src="{{asset('images/app/true.png')}}" style="height: 24px; width: 24px; margin-left: 5%; margin-top: -4px;" alt="TrueImage">
                                                @else
                                                    <img src="{{asset('images/app/false.png')}}" style="height: 24px; width: 24px; margin-left: 5%; margin-top: -4px;" alt="FalseImage">
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            @endif
                        </div><!-- End -->
                        <div id="projectsjoined" hidden="true" class="col">
                            @if(sizeof($teammate_projects)===0)
                                <div class="row" style="margin-left: 5%; width: 70%;">
                                    <h1>Non ci sono progetti in cui sei teammate terminati</h1>
                                </div>
                            @else
                                <table class="table table-fixed">
                                    <caption></caption>
                                    <thead>
                                    <tr>
                                        <th scope="col" class="col-3" style="background-color: #f8b323;">Nome Progetto</th>
                                        <th scope="col" class="col-3" style="background-color: #f8b323;">Data Inizio</th>
                                        <th scope="col" class="col-3" style="background-color: #f8b323;">Data Fine</th>
                                        <th scope="col" class="col-3" style="background-color: #f8b323;">Stato</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teammate_projects as $project)
                                        @if($project->state===1)
                                        <tr>
                                            <th scope="row" class="col-3" style="width: 100%; word-wrap: break-word;">{{$project->name}}</th>
                                            <td class="col-3">{{\Carbon\Carbon::parse($project->idea_start_at)}}</td>
                                            <td class="col-3">{{\Carbon\Carbon::parse($project->end_date)}}</td>
                                            <td class="col-3">
                                                @if($project->ended)
                                                    <img src="{{asset('images/app/true.png')}}" style="height: 24px; width: 24px; margin-left: 5%; margin-top: -4px;" alt="TrueImage">
                                                @else
                                                    <img src="{{asset('images/app/false.png')}}" style="height: 24px; width: 24px; margin-left: 5%; margin-top: -4px;" alt="FalseImage">
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    </tbody>

                                </table>
                            @endif
                        </div><!-- End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/navbartab.css')}}">
    <link rel="stylesheet" href="{{asset('css/Bootstrap-4---Table-Fixed-Header.css')}}">

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

@section('scripts')
    <script>

        $('#allprojectsbtn').click(function () {
            $('#allprojects').prop('hidden',false);
            $('#activeprojects').prop('hidden',true);
            $('#projectsjoined').prop('hidden',true);
        });

        $('#myprojectsbtn').click(function () {
            $('#allprojects').prop('hidden',true);
            $('#activeprojects').prop('hidden',false);
            $('#projectsjoined').prop('hidden',true);
        });

        $('#joinedprojectsbtn').click(function () {
            $('#allprojects').prop('hidden',true);
            $('#activeprojects').prop('hidden',true);
            $('#projectsjoined').prop('hidden',false);
        });

    </script>
@endsection
