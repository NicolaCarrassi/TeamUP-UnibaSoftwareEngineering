@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h2>{{ __('Descrivi la tua Idea') }}</h2>
                        <img src="{{asset('/images/idea/lampadina.png')}}" class="rounded-circle" height="60px" width="100px" alt=""/>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" onsubmit="return controlNeedToMeetAndCity()" action="{{ route('storeProjectualIdea', ['tipology'=>0, 'id'=>0]) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="nameIdea"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Nome Idea') }}</label>

                                <div class="col-md-6">
                                    <input id="nameIdea" type="text" maxlength="50" minlength="2"
                                           class="form-control @error('nameIdea') is-invalid @enderror" name="nameIdea"
                                           value="{{ old('nameIdea') }}" required autocomplete="nameIdea" autofocus>

                                    @error('nameIdea')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Descrizione') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" maxlength="300" rows="5" style="resize:none;"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description"  required autocomplete="description">{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>

                                <div class="col-md-6">
                                    <select id="category" name="category"
                                            class="form-control @error('category') is-invalid @enderror"
                                            required autocomplete="category" autofocus>
                                        @if(old('category') === null)
                                            <option value="" disabled selected hidden> -- seleziona una categoria -- </option>
                                            @foreach($categorie as $categoria)
                                                <option value="{{$categoria->category}}"> {{$categoria->category}} </option>
                                            @endforeach
                                        @else
                                            <option value="{{old('category')}}" selected> {{old('category')}} </option>
                                            @foreach($categorie as $categoria)
                                                @if($categoria->category !== old('category'))
                                                    <option value="{{$categoria->category}}"> {{$categoria->category}} </option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>

                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="numberOfComponentsRequired" class="col-md-4 col-form-label text-md-right">{{ __('Numero di Componenti') }}</label>

                                <div class="col-md-6">
                                    <input id="numberOfComponentsRequired" type="number" min="2" max="100"
                                           class="form-control @error('numberOfComponentsRequired') is-invalid @enderror"
                                           name="numberOfComponentsRequired" value="{{ old('numberOfComponentsRequired') }}" required
                                           autocomplete="numberOfComponentsRequired" autofocus>

                                    @error('numberOfComponentsRequired')
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

                                <div class="col-md-6">
                                    <select class="custom-select" data-browse="down" id="competences"
                                            name="competences">
                                        <option value="" disabled selected hidden> --seleziona una competenza-- </option>
                                        @foreach($competenze as $competenza)
                                            <option
                                                value="{{$competenza->competence}}"> {{$competenza->competence}}</option>
                                        @endforeach
                                    </select>

                                    <div class="d-flex">
                                        <select class="custom-select offset-lg-0 mt-3 d-flex" data-browse="down"
                                                id="livello"
                                                aria-label="Aggiungi competenza">
                                            <option value="" disabled selected hidden> --seleziona il livello-- </option>
                                            <option value="1"> Scarsa</option>
                                            <option value="2"> Intermedia</option>
                                            <option value="3"> Avanzata</option>
                                        </select>

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
                                    <div class="col-md-6">
                                        <input class="form-control"  type="text" id="otherCompetences" name="otherCompetences" placeholder="Inserisci altre competenze">
                                        <div class="d-flex">
                                            <select class="custom-select offset-lg-0 mt-3 d-flex" data-browse="down" id="livelloNewCompetences"
                                                    aria-label="Aggiungi competenza">
                                                <option value="" disabled selected hidden> --seleziona il livello-- </option>
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

                                <table class="table align-content-center" id="lista_competenze" name="lista_competenze"
                                       hidden="true">
                                    <caption>Competenze richieste</caption>
                                    <thead>
                                    <tr>
                                        <th scope="col">Competenza</th>
                                        <th scope="col">Livello</th>
                                        <th scope="col">Rimuovi</th>
                                    </tr>
                                    </thead>
                                </table>

                            <div class="form-group row ">

                                <div class="toggle">
                                    <input type="checkbox" id="toggleShowMore" class="check" onclick="showOption()">
                                    <strong class="b switch"></strong>
                                    <strong class="b track"></strong>
                                </div>

                            </div>


                            <div id="myOption" class="mt-5" hidden="true">

                                <div class="form-group row">
                                    <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Icona Idea') }}</label>

                                    <div class="col-md-6">

                                        <div class="custom-file">
                                            <input type="file" id="image"
                                                   class="custom-file-input form-control-file @error('image') is-invalid @enderror"
                                                   name="image" value="{{ old('image') }}"
                                                   autocomplete="image" autofocus onchange="cambioImmagine('image')">
                                            <label id="labelImmagine" class="custom-file-label" for="image">Scegli un immagine...</label>
                                        </div>


                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="needToMeet" class="col-md-4 col-form-label text-md-right">{{ __('Necessità di Incontro') }}</label>

                                    <div class="col-md-6 ml-2">
                                            <div class="toggle">
                                                <input type="checkbox" id="needToMeet" name="needToMeet" class="check" value="{{ old('needToMeet') }}" autocomplete="needToMeet" autofocus>
                                                <strong class="b switch"></strong>
                                                <strong class="b track"></strong>
                                            </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Città') }}</label>
                                    <div class="col-md-6">
                                        @include('components.citta', ['citta'=>$citta, 'db_city'=>null])
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 input-group-prepend">
                                    <input type="submit" value="{{ __('Aggiungi Idea') }}" class="btn btn-warning font-weight-bold">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('/js/scriptCompetenze.js')}}"></script>
    <script src="{{asset('/js/createProjectualIdea.js')}}"></script>
    <script src="{{asset('/js/imageScript.js')}}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('/css/checkboxstyle.css')}}">
@endsection
