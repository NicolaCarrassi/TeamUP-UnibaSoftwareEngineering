@extends('idea.riepilogativePageTemplate')

@section('content')
    @parent
    <div class="col"  style="margin-left: 22%; width: 78%; padding: 0%;">
        <div class="row" style="width: 70%;">
            <h2 style="margin-left: 30px;"><strong>Compiti Progetto</strong></h2>
        </div>
        <div class="row mt-2" style="margin: 0%; background-color: #b2b2b2; width: 100%;">
            <div class="row mt-4" style="margin: 0; width: 100%;">
                @if(count($compiti) < 2)
                    @foreach($compiti as $compito)
                        <div class="row mt-2 text-white font-weight-bold" style="margin: 0; width: 100%;">
                            <span class="circleYellow" style="margin-left: 22px; position:relative; top:-30%"></span>
                                <div class="col-md-10" style="word-wrap: break-word;">
                                    <p style="font-size: 18px;">{{$compito->description}}</p>
                                </div>
                            <label class="rounded" style="height: 30px; padding-right: 8px; padding-left: 8px; margin-left: 16px; background-color: #f8b323;">{{$compito->username}}</label>
                        </div>
                    @endforeach
                @else
                    @for($i = 0; $i < 2; $i++)
                        <div class="row mt-2 text-white font-weight-bold" style="margin: 0; width: 100%;">
                            <span class="circleYellow" style="margin-left: 22px; position:relative; top:-30%"></span>
                            <div class="col-md-10" style="word-wrap: break-word;">
                                <p style="font-size: 18px;">{{$compiti[$i]->description}}</p>
                            </div>
                            <label class="rounded" style="height: 30px; padding-right: 8px; padding-left: 8px; margin-left: 16px; background-color: #f8b323;">{{$compiti[$i]->username}}</label>
                        </div>
                    @endfor
                @endif
            </div>
            <div class="row" style="width: 100%;">
                @can('update', $progetto)
                    @if($progetto->project_end_at === false)
                        <button id="btnAssegnaCompiti" type="button" class="btn btn-secondary ml-auto" onclick="showAddNewTask()"><strong>Assegna compiti</strong></button>
                        <button id="btnMostraCompiti" type="button" class="btn btn-secondary ml-0" onclick="showAllTasks()"><strong>Mostra tutti i compiti</strong></button>
                    @else
                        <button id="btnMostraCompiti" type="button" class="btn btn-secondary ml-auto" onclick="showAllTasks()"><strong>Mostra tutti i compiti</strong></button>
                    @endif
                @endcan
                @cannot('update', $progetto)
                    <button id="btnMostraCompiti" type="button" class="btn btn-secondary ml-auto" onclick="showAllTasks()"><strong>Mostra tutti i compiti</strong></button>
                @endcannot
            </div>
        </div>
        <div class="row mt-4" style="width: 70%;">
            <h2 style="margin-left: 30px;"><strong>Aggiornamenti Progetto</strong></h2>
        </div>
        <div class="row mt-2" style="margin: 0; width: 100%;">
            @if(count($aggiornamenti) < 2)
                @foreach($aggiornamenti as $aggiornamento)
                    <div class="row mt-2" style="margin: 0; width: 100%;">
                        <label class="rounded text-white" style="height: 30px; padding-right: 8px; padding-left: 8px; margin-left: 16px; background-color: #41A317;">{{$aggiornamento->username}}</label>
                        <div class="col-md-10" style="word-wrap: break-word;">
                            <p class="text-dark font-weight-bold">{{$aggiornamento->description}}</p>
                        </div>
                    </div>
                @endforeach
            @else
                @for($i = 0; $i < 2; $i++)
                    <div class="row mt-2" style="margin: 0; width: 100%;">
                        <label class="rounded text-white" style="height: 30px; padding-right: 8px; padding-left: 8px; margin-left: 16px; background-color: #41A317;">{{$aggiornamenti[$i]->username}}</label>
                        <div class="col-md-10" style="word-wrap: break-word;">
                            <p class="text-dark font-weight-bold">{{$aggiornamenti[$i]->description}}</p>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
        <div class="row" style="width: 100%;">
            <button id="btnMostraAggiornamenti" type="button" class="btn btn-secondary ml-auto" onclick="showAllFeeds()"><strong>Mostra aggiornamenti</strong></button>
        </div>
        @if($progetto->project_end_at === false)
            <form method="POST" action="{{route('addNewFeed', $progetto->id)}}">
                @csrf
                <div class="form-group row mt-5" style="margin: 0; width: 100%;">
                    <div class="col-md-10">
                        <input id="feed" type="text" maxlength="150" minlength="2" style="width: 100%;"
                               placeholder="Inserisci qui un aggiornamento sul progetto"
                               class="form-control rounded @error('feed') is-invalid @enderror" name="feed"
                               value="{{ old('feed') }}" required autocomplete="feed" autofocus>

                        @error('feed')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Aggiungi" class="btn btn-warning font-weight-bold">
                    </div>
                </div>
            </form>
        @endif
        <p id="typeModalTable" hidden="true">0</p>
    </div>
    @include('idea.modalAssignedTask', $compiti)
    @include('idea.modalFeeds', $aggiornamenti)
    @include('idea.modalTaskLeader', $progetto)
@endsection
