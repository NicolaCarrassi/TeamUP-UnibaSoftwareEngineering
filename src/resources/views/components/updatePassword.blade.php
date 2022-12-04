<!-- Componente modal per la segnalazione delle idee progettuali e dei progetti -->

<div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog" aria-labelledby="updatePasswordModal" aria-hidden="true" style="border: 1px black solid; background-blend-mode: darken">
    <div class="modal-dialog modal-dialog-centered modal" role="document">
        <div class="modal-content">
            <div id="modheader" class="modal-header" style="background-color: #f8b323">
                <h5 class="modal-title" id="ModalTitle">Modifica la tua password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST"  action="{{route('changePassword')}}">
                 <div class="modal-body">
                    @csrf
                    @if(Auth::user()->password !== null)
                        <div class="form-group row">
                            <label for="oldPassword"
                                   class="col-md-4 col-form-label">{{ __('Vecchia Password') }}</label>
                            <div class="col-md-6">
                                <input id="oldPassword" type="password"name="oldPassword" required>
                            </div>
                        </div>
                    @endif
                    <div class="form-group row">
                        <label for="password"
                               class="col-md-4 col-form-label">{{ __('Nuova Password') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password" name="password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm"
                               class="col-md-4 col-form-label">{{ __('Conferma la tua password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" name="password_confirmation" required>
                        </div>
                    </div>
                 </div>

                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Annulla </button>
                        <button type="submit" class="btn btn-warning"> Modifica password </button>
                    </div>
            </form>
        </div>
    </div>
</div>
