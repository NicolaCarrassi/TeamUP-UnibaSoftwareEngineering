<div id="visualizzaFeeds" class="modal fade" tabindex="-1" role="dialog" style="margin-top: 5%;" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8b323">
                <h5 id="feedsHeader" class="modal-title"><strong>Aggiornamenti progetto</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if(count($aggiornamenti) === 0)
                <div class="modal-body" style="overflow-x: hidden; overflow-y: auto; max-height: 400px;">
                    <p class="text-dark" style="font-size: 16px;"><strong>Nessun aggiornamento presente</strong></p>
                </div>
            @else
                <div class="modal-body" style="overflow-x: hidden; overflow-y: auto;">
                    <div id="table_data_feeds">
                        @include('components.feeds-assinged-modal-table')
                    </div>
                </div>
            @endif
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><strong>Esci</strong></button>
            </div>
        </div>
    </div>
</div>
