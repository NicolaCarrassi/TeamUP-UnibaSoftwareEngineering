@extends('profileview.profiletemp')

@section('content')
    @parent

    <div class="col" style="margin-left: 21.2%; width: 78%;">
        <div class="container-fluid">
            <div class="row" style="height: 100%;">
                <div class="col mx-auto bg-white rounded shadow">
                    <div class="table-responsive">
                        <table id="allprojects" class="table table-responsive">
                            <caption></caption>
                            <thead>
                            <tr>
                                <th scope="col" class="col-4" style="width: 50%; background-color: #f8b323;">Nome Progetto</th>
                                <th scope="col" class="col-4" style="width: 50%; background-color: #f8b323;">Data Inizio</th>
                                <th scope="col" class="col-4" style="background-color: #f8b323;">Ruolo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($leader_projects as $leader_project)
                                <tr>
                                    <th scope="row" class="col-4" style="width: 50%; word-wrap: break-word;"><a href="{{route('riepilogativePage',$leader_project->id)}}" class="text-dark">{{$leader_project->name}}</a></th>
                                    <td class="col-4" style="width: 50%">{{\Carbon\Carbon::parse($leader_project->idea_start_at)}}</td>
                                    <td class="col-4">Leader<br></td>
                                </tr>
                            @endforeach
                            @foreach($teammate_projects as $teammate_project)
                                <tr>
                                    <th scope="row" class="col-4" style="width: 50%; word-wrap: break-word;"><a href="{{route('riepilogativePage',$teammate_project->id)}}" class="text-dark">{{$teammate_project->name}}</a></th>
                                    <td class="col-4" style="width: 50%">{{\Carbon\Carbon::parse($teammate_project->idea_start_at)}}</td>
                                    <td class="col-4">Teammate<br></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- End -->
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
