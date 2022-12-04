@extends('layouts.app')

@section('content')

    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" id="app">{{ __('Effettua la registrazione') }}</div>
                    <br>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register')}}" enctype="multipart/form-data">
                            @csrf

                            <br>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right"
                                       data-toggle="tooltip" title="Inserisci il tuo username">
                                    {{ __('Username') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="text"
                                           class="form-control @error('username') is-invalid @enderror" name="username"
                                           value="{{ old('username') }}" required autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <br>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Cognome') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text"
                                           class="form-control @error('surname') is-invalid @enderror" name="surname"
                                           value="{{ old('surname') }}" required>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="birth_date"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Data di nascita') }}</label>

                                <div class="col-md-6">
                                    <input id="birth_date" type="date"
                                           class="form-control @error('birth_date') is-invalid @enderror"
                                           name="birth_date" value="{{ old('birth_date') }}" required>

                                    @error('birth_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city"
                                       class="col-md-4 col-form-label text-md-right">Scegli la tua città
                                    <br>
                                    <span class="text-small text-info">Opzionale</span>
                                </label>
                                <div class="col-md-6">
                                    @include('components.citta',['citta'=>$citta, 'db_city'=>null])
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Conferma la tua password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">Carica un immagine:
                                    <br>
                                    <span class="text-small text-info">Opzionale</span>
                                </label>
                                <div class="col-md-6 ">

                                    <div class="custom-file">
                                        <input type="file" id="avatar"
                                               class="custom-file-input form-control-file @error('avatar') is-invalid @enderror"
                                               name="avatar" value="{{ old('avatar') }}"
                                               autocomplete="avatar" autofocus onchange="cambioImmagine('avatar')">
                                        <label id="labelImmagine" class="custom-file-label" for="avatar">Scegli un immagine...</label>
                                    </div>

                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="competences" class="col-md-4 col-form-label text-right"> Inserisci la lista
                                    <br>delle tue competenze <br>
                                    <span class="text-small text-info">Puoi modificarla in <br>ogni momento</span>
                                </label>

                                <!-- lista delle competenze presa da database -->
                                <div class="col-md-6">
                                    <select class="custom-select" data-browse="down" id="competences"
                                            name="competences">
                                        <option selected value="-1">Seleziona una competenza</option>
                                        @foreach($competenze as $competenza)
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

                            <!-- Aggiunta di nuove competenze -->
                            <div class="form-group row">
                                <label for="otherCompetences" class="col-md-4 col-form-label text-right"> Altre competenze </label>
                                <div class="col-md-6">
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

                            <!-- Bottone di invio per la registrazione -->
                            <div class="form-group row mb-3 mr-4">
                                <div class="col-md-6 offset-md-10">
                                    <button class="btn btn-outline-primary" type="submit">
                                        {{ __('Registrati')}}
                                    </button>
                                </div>
                            </div>

                            <!-- Tabella delle competenze dell'utente -->
                            <table class="table align-content-center" id="lista_competenze" name="lista_competenze"
                                   hidden="true">
                                <caption></caption>
                                <thead>
                                <tr>
                                    <th scope="col">Competenza</th>
                                    <th scope="col">Livello</th>
                                    <th scope="col">Rimuovi</th>
                                </tr>
                                </thead>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{asset('/js/scriptCompetenze.js')}}"> </script>
    <script src="{{asset('/js/imageScript.js')}}"></script>
@endsection
