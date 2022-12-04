@extends('admin.adminprofiletemp')

@section('content')
    <div class="col" style="margin-left: 21.5%; width: 78%;">
        <div class="container-fluid">
            <h1>Tutte le idee progettuali</h1>
            <div class="row" style="height: 100%;">
                <div class="col mx-auto bg-white rounded shadow">
                    <div class="table-responsive">
                        <table id="allprojects" class="table table-fixed">
                            <caption class="p-0"></caption>
                            <tbody>
                            @foreach($all_ideas as $idea)
                                <tr>
                                    <th scope="row" class="col-2">
                                        {{$idea->name}}
                                        <div id="description_projects{{$idea->id}}" class="row" hidden="true" style="margin-left: 0%; width: 90%;">
                                            <br>Descrizione:<br>
                                            @for($i=0;$i<(strlen($idea->description)/150);$i++)
                                                {{substr($idea->description,150*$i,150*($i+1))}}<br>
                                            @endfor
                                        </div>
                                    </th>
                                    <th scope="row">
                                        <div id="delete_button{{$idea->id}}" class="row" hidden="true">
                                            <button id="deletebtn" name="btn" onclick="showConfirmModal('deletebtn','Eliminazione idea','Confermi l_eliminazione del progetto?')" value="{{route('deleteproject',$idea->id)}}" type="button" class="btn button font-weight-bold" style="margin-top: 100%; height: 35px; width: 100px;">Elimina</button>
                                        </div>
                                    </th>
                                    <th scope="row" class="col-2">
                                        <button id="showdescbtn_projects{{$idea->id}}" class="btn font-weight-bold" onclick="showDescription(-1,{{$idea->id}},-1)" style="font-size: 18px;">+</button>
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
    @include('components.modalconfirm')
@endsection

@section('scripts')
    <script src="{{asset('/js/scriptConfirm.js')}}"></script>
@endsection


