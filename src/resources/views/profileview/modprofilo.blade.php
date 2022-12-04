@extends('profileview.profiletemp')

@section('content')
    @parent

    <div class="col pl-0"  style="margin-left: 25%; width: 60%;">
        <div class="row" style="width: 40%; padding-left: 1%;">
            <h1>Modifica Profilo</h1>
        </div>
        <form method="post" action="{{route('confmod')}}"  enctype="multipart/form-data" style="margin-top:10%; width: 50%;">
            @csrf
            <div class="form-group">
                <label for="username"> Username </label>
                <input type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') ?? $user->username }}">
            </div>
            <div class="form-group">
                <label for="email"> Email </label>
                <input type="email" class="form-control" name="email" placeholder="name@example.com" value="{{ old('email') ?? $user->email }}">
            </div>
            <div class="form-group">
                <label for="name"> Nome completo </label>
                <input type="text" class="form-control" name="name" placeholder="Nome Completo" value="{{ old('name') ?? $user->name}}">
            </div>

            <div class="form-group">
                <label for="birth_date">{{ __('Data di nascita') }}</label>

                <input id="birth_date" type="date"
                       class="form-control @error('birth_date') is-invalid @enderror"
                       name="birth_date" value="{{ old('birth_date') ?? $user->birth_date }}">

                    @error('birth_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>



            <div class="form-group">
                <label for="name"> Città </label>
                @include('components.citta',['citta'=>$citta, 'db_city'=> $user->city])
            </div>

            <div class="form-group row">
                <label for="avatar" class="col col-form-label">Immagine del profilo</label>
            </div>
                <div class="col">
                    <input type="file" id="avatar"
                           class="custom-file-input form-control-file @error('avatar') is-invalid @enderror"
                           name="avatar"
                           autocomplete="avatar" autofocus onchange="updateImage('avatar')">
                    <label id="labelImmagine" class="custom-file-label" for="avatar">Scegli un immagine...</label>
                    <input type="hidden" name="ImageUpdate" id="ImageUpdate" value="no">
                    @error('avatar')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                     </span>
                    @enderror
                </div>



            <div class="form-group row mt-5">
                <label for="competences" class="col-md-4 col-form-label text-right"> Inserisci la lista
                    <br>delle tue competenze<br>
                </label>

                <!-- lista delle competenze presa da database -->
                <div class="col">
                    <select class="custom-select" data-browse="down" id="competences"
                            name="competences">
                        <option selected value="-1">Seleziona una competenza</option>
                        @foreach($allcompetenze as $competenza)
                            <option
                                value="{{$competenza->competence}}"> {{$competenza->competence}}</option>
                        @endforeach
                    </select>

                    <!-- Lista per la selezione dei livelli delle competenze-->
                    <div class="d-flex">
                        <select class="custom-select offset-lg-0 mt-3 d-flex" data-browse="down"
                                id="livello"
                                aria-label="Aggiungi competenza">
                            <option value="0"> Seleziona il livello...</option>
                            <option value="1"> Scarsa</option>
                            <option value="2"> Intermedia</option>
                            <option value="3"> Avanzata</option>
                        </select>

                        <!-- Tasto per l'aggiunta delle competenze -->
                        <div class="input-group-prepend  mt-3">
                            <button class="btn btn-outline-secondary" type="button"
                                    onclick="addElementInTable()">
                                Aggiungi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="otherCompetences" class="col-md-4 col-form-label text-right"> Altre competenze </label>
                <div class="col">
                    <input class="form-control"  type="text" id="otherCompetences" name="otherCompetences" placeholder="Inserisci altre competenze">
                    <div class="d-flex">
                        <select class="custom-select offset-lg-0 mt-3 d-flex" data-browse="down" id="livelloNewCompetences"
                                aria-label="Aggiungi competenza">
                            <option value="0"> Seleziona il livello...</option>
                            <option value="1"> Scarsa</option>
                            <option value="2"> Intermedia</option>
                            <option value="3"> Avanzata</option>
                        </select>

                        <div class="input-group-prepend  mt-3">
                            <button class="btn btn-outline-secondary" type="button" onclick="altreCompetenze()">
                                Aggiungi
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table align-content-center" id="lista_competenze" name="lista_competenze">
                <caption>Competenze inserite</caption>
                <thead>
                <tr>
                    <th scope="col">Competenza</th>
                    <th scope="col">Livello</th>
                    <th scope="col">Rimuovi</th>
                </tr>
                @foreach($usercomp as $competenza)
                    <tr>
                        <td id="{{$competenza->competence}}">{{$competenza->competence}}</td>
                        @switch($competenza->level)
                            @case(1)
                            <td id="{{$competenza->level}}">Scarsa</td>
                            @break
                            @case(2)
                            <td id="{{$competenza->level}}">Intermedia</td>
                            @break
                            @case(3)
                            <td id="{{$competenza->level}}">Avanzata</td>
                            @break
                        @endswitch
                        <td><button type="button" class="btn btn-secondary-sm" onclick="removeRow(this)">-</button></td>
                        <td><input id="{{str_replace(' ','_',$competenza->competence)}}" name="{{str_replace(' ','_',$competenza->competence)}}" type="hidden" value="{{$competenza->level}}"></td>
                    </tr>
                @endforeach
                </thead>
            </table>
            <p class="mt-4 mb-3"><a data-toggle="modal"
                                    data-target="#updatePasswordModal", data-id="{{Auth::id()}}"> Modifica la password </a></p>
            <input type="submit" class="btn" value="Invia" style="height: 40px; width: 100px; color: #ffffff; background-color: #f8b323; border-color: #f8b323;">
            <button id="cancprofbtn" type="button" onclick="showConfirmModal('cancprofbtn','Cancellazione profilo','Confermi la cancellazione del profilo?')" class="btn btn-secondary" value="{{route('cancprofilo')}}" style="margin-left: 1%;">
                Cancella Profilo
            </button>
        </form>
    </div>
    @include('components.modalconfirm')
    @include('components.updatePassword')
@endsection

@section('scripts')
    <script src="{{asset('/js/scriptConfirm.js')}}"></script>
    <script src="{{asset('/js/imageScript.js')}}"></script>
    <script src="{{asset('/js/scriptCompetenze.js')}}"></script>
    <script>

        function updateImage(elem){
            let hidden = document.getElementById('ImageUpdate')
            if(hidden.value === 'no')
                hidden.setAttribute('value', 'yes');

            cambioImmagine(elem);
        }

        var msg = '{{Session::get('alert')}}';
        var exist = '{{Session::has('alert')}}';
        if(exist){
            alert(msg);
        }
    </script>

@endsection
