@extends('admin.adminprofiletemp')

@section('content')
    <div class="col p-0" style="margin-right: 0%; margin-left: 22%; width: 76%;">
        <div class="row" style="margin-left: 10%;">
            <h2><strong>Nuove segnalazioni:</strong></h2>
        </div>
            @foreach($all_reports_users as $report_user)
                    <div class="row" style="margin-left: 10%; width: 40%;">
                        <h3><span class="circle"></span> {{$report_user->user1_username}} ha segnalato {{$report_user->user2_username}}</h3>
                    </div>
            @endforeach
            @foreach($all_reports_projects as $report_project)
                <div class="row" style="margin-left: 10%; width: 60%;">
                    @if($report_project->idea_start_at===null)
                        <h3><span class="circle"></span> {{$report_project->username}} ha segnalato l'idea {{$report_project->name}}</h3>
                    @else
                        <h3><span class="circle"></span> {{$report_project->username}} ha segnalato il progetto {{$report_project->name}}</h3>
                    @endif
                </div>
            @endforeach
        <div class="row">
            <a href="{{route('adminreports',$admin->id)}}" style="margin-left: 11%;"><button class="btn button font-weight-bold">
                Mostra tutti
            </button></a>
        </div>
        <div class="row" style="margin-top: 20%; height: 20%; background-color: #353132; width: 80%; margin-right: 0%; margin-left: 10%;">
            <h1 style="color:#ffffff; font-size: 70px; margin-left: 10%; margin-top: 2%;">Ultime idee progettuali inserite</h1>
        </div>
            @foreach($all_idea as $idea)
                <div class="row" style="margin-left: 10%; width: 40%;">
                    <h3><span class="circle"></span> Idea n.{{$idea->id}}: {{$idea->name}}</h3>
                </div>
            @endforeach
        <div class="row">
            <a href="{{route('adminideas',$admin->id)}}" style="margin-left: 11%;"><button class="btn button font-weight-bold">
                    Mostra tutti
                </button></a>
        </div>
@endsection
