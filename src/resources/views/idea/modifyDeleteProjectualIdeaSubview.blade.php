<div class="form-group row">
    <label for="nameIdea" class="col-md-4 col-form-label text-md-right">{{ __('Nome Idea') }}</label>

    <div class="col-md-6">
        <input id="nameIdea" type="text" maxlength="50" minlength="2"
               class="form-control @error('nameIdea') is-invalid @enderror" name="nameIdea"
               value="{{ old('nameIdea') ?? $progetto->name }}" required autocomplete="nameIdea" autofocus>

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
        <textarea id="description" maxlength="300" rows="5" style="resize:none;" wrap="hard"
                  class="form-control @error('description') is-invalid @enderror"
                  name="description" required autocomplete="description">{{ old('description') ?? $progetto->description }}</textarea>

        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>

    <div class="col-md-6">
        <select id="category" name="category" class="form-control @error('category') is-invalid @enderror"
                required autocomplete="category" autofocus>
            <option value="{{old('category') ?? $progetto->category_id}}" selected> {{old('category') ??
                $progetto->category_id}}</option>
            @if(old('category') === null)
                @foreach($categorie as $categoria)
                    @if($categoria->category !== $progetto->category_id)
                        <option value="{{$categoria->category}}"> {{$categoria->category}}</option>
                    @endif
                @endforeach
            @else
                @foreach($categorie as $categoria)
                    @if($categoria->category !== old('category'))
                        <option value="{{$categoria->category}}"> {{$categoria->category}}</option>
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
    <label for="numberOfComponentsRequired" class="col-md-4 col-form-label text-md-right">{{ __('Numero di Componenti')
        }}</label>

    <div class="col-md-6">
        <input id="numberOfComponentsRequired" type="number" min="2" max="100"
               class="form-control @error('numberOfComponentsRequired') is-invalid @enderror"
               name="numberOfComponentsRequired"
               value="{{ old('numberOfComponentsRequired') ?? $progetto->numberOfComponentsRequired }}" required
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
            <option value="" disabled selected hidden> --seleziona una competenza--</option>
            @foreach($competenze as $competenza)
                <option
                    value="{{$competenza->competence}}"> {{$competenza->competence}}
                </option>
            @endforeach
        </select>

        <div class="d-flex">
            <select class="custom-select offset-lg-0 mt-3 d-flex" data-browse="down"
                    id="livello"
                    aria-label="Aggiungi competenza">
                <option value="" disabled selected hidden> --seleziona il livello--</option>
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
        <input class="form-control" type="text" id="otherCompetences" name="otherCompetences" placeholder="Inserisci altre competenze">
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
    <caption>Competenze richieste</caption>
    <thead>
    <tr>
        <th scope="col">Competenza</th>
        <th scope="col">Livello</th>
        <th scope="col">Rimuovi</th>
    </tr>
    @for($i = 0; $i < count($competenze_richieste); $i++)
        <tr id="{{$i+1}}" name="{{$i+1}}">
            <td id="{{$competenze_richieste[$i]->competence}}">{{$competenze_richieste[$i]->competence}}</td>
            <td id="{{\App\Level::getNumberLevel($competenze_richieste[$i]->level)}}">{{$competenze_richieste[$i]->level}}
            </td>
            <td>
                <button type="button" class="btn btn-secondary-sm" onclick="removeRow(this)">-</button>
            </td>
            <td><input id="{{str_replace(' ', '_', $competenze_richieste[$i]->competence)}}"
                       name="{{str_replace(' ', '_', $competenze_richieste[$i]->competence)}}" type="hidden"
                       value="{{\App\Level::getNumberLevel($competenze_richieste[$i]->level)}}"></td>
        </tr>
    @endfor
    </thead>
</table>

<div class="form-group row ">
    <div class="toggle">
        <input type="checkbox" id="toggleShowMore" class="check" onclick="showOption()">
        <strong class="b switch"></strong>
        <strong class="b track"></strong>
    </div>
</div>

<div id="myOption" hidden="true">
    <div class="form-group row">
        <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Icona Idea') }}</label>
        <div class="col-md-6">
            <input type="file" id="image"
                   class="custom-file-input form-control-file @error('image') is-invalid @enderror"
                   name="image"
                   autocomplete="image" autofocus onchange="cambioImmagine('image')">
            <label id="labelImmagine" class="custom-file-label" for="image">Scegli un immagine...</label>

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
                @if($progetto->needToMeet == 1)
                    <input type="checkbox" id="needToMeet" name="needToMeet" class="check" checked autocomplete="needToMeet"
                           autofocus>
                    <strong class="b switch"></strong>
                    <strong class="b track"></strong>
                @else
                    <input type="checkbox" id="needToMeet" name="needToMeet" class="check" autocomplete="needToMeet"
                           autofocus>
                    <strong class="b switch"></strong>
                    <strong class="b track"></strong>
                @endif
            </div>
        </div>
    </div>

    <div class="form-group row">
        <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Città') }}</label>
        <div class="col-md-6">
            @include('components.citta', ['citta'=>$citta, 'db_city'=>$progetto->city])
        </div>
    </div>
</div>


@section('css')
<style>

    .toggle {
        position: relative;
        top: 50%;
        left: 8%;
        width: 45px;
        height: 25px;
        border-radius: 100px;
        background-color: #ddd;
        margin: -10px -40px;
        overflow: hidden;
        box-shadow: inset 0 0 2px 1px rgba(0, 0, 0, .05);
    }

    .check {
        position: absolute;
        display: block;
        cursor: pointer;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        z-index: 6;
    }

    .check:checked ~ .track {
        box-shadow: inset 0 0 0 20px #f8b323;
    }

    .check:checked ~ .switch {
        right: 2px;
        left: 22px;
        transition: .35s cubic-bezier(0.785, 0.135, 0.150, 0.860);
        transition-property: left, right;
        transition-delay: .05s, 0s;
    }

    .switch {
        position: absolute;
        left: 2px;
        top: 2px;
        bottom: 2px;
        right: 22px;
        background-color: #fff;
        border-radius: 36px;
        z-index: 1;
        transition: .35s cubic-bezier(0.785, 0.135, 0.150, 0.860);
        transition-property: left, right;
        transition-delay: 0s, .05s;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2);
    }

    .track {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        transition: .35s cubic-bezier(0.785, 0.135, 0.150, 0.860);
        box-shadow: inset 0 0 0 2px rgba(0, 0, 0, .05);
        border-radius: 40px;
    }


</style>
@endsection
