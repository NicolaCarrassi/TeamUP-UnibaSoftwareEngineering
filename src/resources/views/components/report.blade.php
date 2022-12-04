<!-- Componente modal per la segnalazione delle idee progettuali e dei progetti -->

<div class="modal fade" id="segnalazioneModal" tabindex="-1" role="dialog" aria-labelledby="segnalazioneModel" aria-hidden="true" style="border: 1px black solid; background-blend-mode: darken">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div id="modheader" class="modal-header" style="background-color: red">
                <h5 class="modal-title" id="ModalTitle">Segnalazione</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" onsubmit="return checkData()" action="{{route('segnalaIdee')}}">
                    @csrf
                    <input type="hidden" id="hiddenButtonIdea" name="project_id">
                    <div class="form-group">
                        <label for="motivoSegnalazione" class="col-form-label">Motivo della segnalazione: </label>
                        <select class="form-control" id="motivoSegnalazione" name="reason">
                            <option disabled selected hidden value="-1">Seleziona una motivazione...</option>
                            <option value ="1">È Spam</option>
                            <option value ="2">Vendita di prodotti</option>
                            <option value ="3">Non è appropriato</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Aggiungi una descrizione:<br>
                            <span class="text-small text-info">Opzionale</span>
                        </label>
                        <textarea class="form-control" id="descriptionRequest" name="description"></textarea>
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
