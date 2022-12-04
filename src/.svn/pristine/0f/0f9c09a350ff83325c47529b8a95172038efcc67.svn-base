@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h2>{{ __('Modifica Idea') }}</h2>
                        <img src="{{asset('/images/idea/modifica.png')}}" class="rounded-circle" height="75px" width="100px" alt="" />
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" onsubmit="return controlNeedToMeetAndCity()" action="{{ route('storeProjectualIdea', ['tipology'=>1, 'id'=>$progetto->id]) }}">
                            @csrf

                            @include('idea.modifyDeleteProjectualIdeaSubview', ['progetto' => $progetto, 'competenze_richieste' => $competenze_richieste, 'competenze' => $competenze, 'categorie' => $categorie, 'citta' => $citta])

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 input-group-prepend">
                                    <input type="submit" value="{{ __('Modifica Idea') }}" class="btn btn-warning font-weight-bold">
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
