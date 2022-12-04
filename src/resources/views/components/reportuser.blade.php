<!-- Componente modal per la segnalazione dell'utente -->

<div class="modal fade" id="segnalazioneModalUser" tabindex="-1" role="dialog" aria-labelledby="segnalazioneModel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div id="modheaderuser" class="modal-header">
                <h5 class="modal-title" id="ModalTitle">Segnalazione dell'utente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" onsubmit="return checkData()" action="{{route('segnalaUser')}}">
                    @csrf
                    <input type="hidden" id="hiddenButtonUser" name="reported_user_id">
                    <div class="form-group">
                        <label for="motivoSegnalazione" class="col-form-label">Motivo della segnalazione: </label>
                        <select class="form-control" id="motivoSegnalazione" name="reason">
                            <option disabled selected hidden value="-1">Seleziona una motivazione...</option>
                            <option value="1">È Spam</option>
                            <option value="2">Non è appropriato</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Aggiungi una descrizione:<br>
                            <span class="text-small text-info">Opzionale</span>
                        </label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annulla </button>
                        <button type="submit" class="btn btn-danger"> Invia segnalazione </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@section('scripts')
    <script src="{{asset('/js/scriptReport.js')}}"></script>
@endsection
