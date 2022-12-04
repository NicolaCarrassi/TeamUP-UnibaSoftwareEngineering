@extends('admin.adminprofiletemp')

@section('content')
<div class="col" style="margin-left: 21.5%; width: 78%;">
    <div class="container-fluid">
        <h1>Accetta competenze</h1>
        <div class="row" style="height: 100%;">
            <div class="col mx-auto bg-white rounded shadow">
                <div class="table-responsive">
                    <table id="allprojects" class="table table-fixed">
                        <caption class="p-0"></caption>
                        <tbody>
                        @foreach($competenze as $competenza)
                            <tr>
                                <th scope="row" class="col-2">
                                    {{$competenza->competence}}
                                    <div id="description_competence{{$competenza->id}}" class="row" hidden="true" style="margin-left: 0%; width: 90%;">
                                        <div class="row" style="margin-top: 6%; margin-left: 80%;">
                                            <input id="hidden_{{$competenza->id}}" value="{{$competenza->id}}" type="text" hidden="true">
                                            <a><button class="btn btn-success font-weight-bold" id="accetta_competenza" value="{{route('accettaCompetenze',$competenza->id)}}" name="accetta_comp_button" type="button" onclick="showConfirmModal('accetta_competenza','Accetta competenza','Confermi l_accettazione della competenza?')">Approva</button></a>
                                            <button class="btn btn-danger ml-3 font-weight-bold" id="rifiuta_competenza" name="rifiuta_comp_button" type="button"><a href="{{route('rifiutaCompetenze',$competenza->id)}}" class="text-white">Rimuovi</a></button>
                                        </div>
                                    </div>
                                </th>
                                <th scope="row" class="col-2">
                                    <button id="showdescbtn_competence{{$competenza->id}}" class="btn font-weight-bold" onclick="showDescription(-1,-1,{{$competenza->id}})" style="font-size: 18px;">+</button>
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.modalconfirm')
@endsection

@section('scripts')
    <script src="{{asset('/js/scriptConfirm.js')}}"></script>
@endsection
