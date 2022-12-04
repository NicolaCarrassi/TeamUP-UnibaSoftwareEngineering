@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h2>{{ __('Elimina Idea') }}</h2>
                        <img src="{{asset('/images/idea/eliminaIdea.png')}}" class="rounded-circle" height="75px" width="100px" alt="" />
                    </div>
                    <div class="card-body">
                        @include('idea.modifyDeleteProjectualIdeaSubview', ['progetto' => $progetto, 'competenze_richieste' => $competenze_richieste, 'competenze' => $competenze, 'categorie' => $categorie, 'citta' => $citta])
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 input-group-prepend">
                                <button id="btnDelete"  type="button" class="btn btn-warning" onclick="showConfirmModal('btnDelete', 'Attenzione!', 'Confermi di voler cancellare la tua idea?')" value="{{route('removeProjectualIdea', ['id'=>$progetto->id])}}">
                                    <strong>{{ __('Elimina Idea') }}</strong>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.modalconfirm')
@endsection

@section('scripts')
    <script src="{{asset('/js/scriptCompetenze.js')}}"></script>
    <script src="{{asset('/js/createProjectualIdea.js')}}"></script>
    <script src="{{asset('/js/imageScript.js')}}"></script>
    <script src="{{asset('/js/scriptConfirm.js')}}"></script>
@endsection
