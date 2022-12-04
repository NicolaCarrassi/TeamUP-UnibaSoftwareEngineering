@extends('admin.adminprofiletemp')

@section('content')
    <div class="col" style="margin-left: 21.2%; width: 78%;">
        <div class="container-fluid">
            <h1>Tutte le segnalazioni</h1>
            <div class="row" style="height: 100%;">
                <div class="col mx-auto bg-white rounded shadow">
                    <div class="table-responsive">
                        <table id="allprojects" class="table table-fixed">
                            <caption class="p-0"></caption>
                            <tbody>
                            @foreach($all_reports_users as $report_user)
                                @if(\Illuminate\Support\Facades\DB::table('report_users')->where('id',$report_user->id)->pluck('managed')->first()===0)
                                <tr>
                                    <form method="post" action="{{route('acceptreport',['report' => 2,'report_type' => 0])}}" enctype="multipart/form-data">
                                        @csrf
                                        <th scope="row" class="col-2">
                                            {{$report_user->user1_username}} ha segnalato {{$report_user->user2_username}}
                                            <div id="description_user{{$report_user->id}}" class="row" hidden="true" style="margin-left: 0%; width: 100%;">
                                                <br>Motivo:
                                                @if($report_user->reason===1)
                                                    E' spam
                                                @else
                                                    Non è appropriato
                                                @endif
                                                <br><br>Descrizione:<br>
                                                @for($i=0;$i<(strlen($report_user->description)/150);$i++)
                                                    {{substr($report_user->description,150*$i,150*($i+1))}}<br>
                                                @endfor
                                                <div class="row" style="margin-top: 5%; margin-left: 80%;">
                                                    <input id="hiddenid_report_rifiuta" name="hiddenid_report_rifiuta" value="{{$report_user->id}}" type="text" hidden="true">
                                                    <a><button value="{{route('acceptreport',['report' => 1, 'report_type' => 0])}}" class="btn btn-danger font-weight-bold" id="sanzbtn_user" onclick="showMod({{$report_user->id}},{{$report_user->user2_id}},-1)" name="btn" type="button">Sanziona</button></a>
                                                    <input class="btn font-weight-bold btn-secondary ml-1" type="submit" value="Rifiuta">
                                                </div>
                                            </div>
                                        </th>
                                    </form>
                                    <th scope="row" class="col-2">
                                        <button id="showdescbtn_user{{$report_user->id}}" class="btn" onclick="showDescription({{$report_user->id}},-1)" style="font-size: 18px;">+</button>
                                    </th>
                                </tr>
                                @endif
                            @endforeach
                            @foreach($all_reports_projects as $report_projects)
                                    <tr>
                                        <form method="post" action="{{route('acceptreport',['report' => 2,'report_type' => 1])}}" enctype="multipart/form-data">
                                            @csrf
                                            <th scope="row" class="col-2">
                                                @if($report_projects->idea_start_at===null)
                                                    {{$report_projects->username}} ha segnalato l'idea {{$report_projects->name}}
                                                @else
                                                    {{$report_projects->username}} ha segnalato il progetto {{$report_projects->name}}
                                                @endif
                                                <div id="description_projects{{$report_projects->id}}" class="row" hidden="true" style="margin-left: 0%; width: 100%;">
                                                    <br>Motivo:
                                                    @switch($report_projects->reason)
                                                        @case(1)
                                                            E' spam
                                                        @break
                                                        @case(2)
                                                            Vendita di prodotti
                                                        @break
                                                        @default
                                                            Non è appropriato
                                                        @break
                                                    @endswitch
                                                    <br><br>Descrizione:<br>
                                                    @for($i=0;$i<(strlen($report_projects->description)/150);$i++)
                                                        {{substr($report_projects->description,150*$i,150*($i+1))}}<br>
                                                    @endfor
                                                    <div class="row" style="margin-top: 5%; margin-left: 80%;">
                                                        <input id="hiddenid_report_rifiuta" name="hiddenid_report_rifiuta" value="{{$report_projects->id}}" type="text" hidden="true">
                                                        <a><button value="{{route('acceptreport',['report' => 1, 'report_type' => 1])}}" class="btn btn-danger" id="sanzbtn_project" onclick="showMod({{$report_projects->id}},-1,{{$report_projects->project_id}})" name="btn" type="button">Sanziona</button></a>
                                                        <input class="btn" type="submit" value="Rifiuta" style="margin-left: 6px; height: 35px; width: 100px; color: #ffffff; background-color: #353132; border-color: #353132;">
                                                    </div>
                                                </div>
                                            </th>
                                        </form>
                                        <th scope="row" class="col-2">
                                            <button id="showdescbtn_projects{{$report_projects->id}}" class="btn" onclick="showDescription(-1,{{$report_projects->id}})" style="font-size: 18px;">+</button>
                                        </th>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- End -->
                </div>
            </div>
        </div>
    </div>
    <div id="confdial" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Accetta sanzione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <form id="conf_form" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <p id="modal_body">Confermi la sanzione?</p>
                            <div id="closedateid" class="form-group row">
                                <label for="closedate"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Data di fine:') }}</label>

                                <div class="col-md-6">
                                    <input id="closedate" type="date"
                                           class="form-control @error('birth_date') is-invalid @enderror"
                                           name="closedate" value="{{ old('birth_date') }}" required>

                                    @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        <div id="banform" class="form-group row">
                            <label for="ban" class="col col-form-label" style="margin-top: 5px;">{{ __('Ban') }}</label>
                            <div class="col" style="margin-right: 70%;">
                                <div class="toggle">
                                    <input type="checkbox" id="ban" value="false" name="ban" class="check" onclick="banUser()" autocomplete="ban" autofocus>
                                    <strong class="b switch"></strong>
                                    <strong class="b track"></strong>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input id="hiddenid_report" name="hiddenid_report" type="text" hidden="true">
                            <input id="hiddenid_object_reported" name="hiddenid_object_reported" type="text" hidden="true">
                            <input type="submit" class="btn button font-weight-bold" value="Conferma" style="height: 40px; width: 100px;">
                            <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Annulla</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function showMod(id_report,user_reported,project_reported) {
            let hiddenid_report = document.getElementById('hiddenid_report');
            let hiddenid_object_reported = document.getElementById('hiddenid_object_reported');
            let conf_form = document.getElementById('conf_form');
            let sanzbtn_user = document.getElementById('sanzbtn_user');
            let sanzbtn_project = document.getElementById('sanzbtn_project');

            hiddenid_report.value = id_report;

            if(user_reported===-1) {
                conf_form.action = sanzbtn_project.value;
                hiddenid_object_reported.value = project_reported;
                $('#banform').prop('hidden',true);
            } else {
                conf_form.action = sanzbtn_user.value;
                hiddenid_object_reported.value = user_reported;
                $('#banform').prop('hidden',false);
            }

            $(document).ready(function () {
                $("#confdial").modal();
            });
        }

        $('#sanzbtn_user').click(function () {
            $('#ban').prop('checked',false);
            $('#closedateid').prop('hidden',false);
            $('#closedate').prop('disabled',false);
        });

        $('#sanzbtn_project').click(function () {
            $('#closedateid').prop('hidden',true);
            $('#closedate').prop('disabled',true);
        });
    </script>
@endsection
