<div id="visualizzaTuttiPartecipanti" class="modal fade" tabindex="-1" role="dialog" style="margin-top: 5%;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8b323">
                <h5 id="teamHeader" class="modal-title"><strong>Membri del team</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('removeTeammates', $progetto->id)}}">
                @csrf
                <div class="modal-body" style="overflow-x: hidden; overflow-y: auto; max-height: 400px;">
                    <table id="table_membri_team" name="membri_team" class="table-responsive">
                        <caption>Membri team</caption>
                        <tr>
                            <th style="max-width: 150px; word-wrap: break-word;" scope="col"><p class="text-dark mr-lg-5" style="font-size: 16px;"><strong>Username</strong></p></th>
                            <th style="max-width: 400px; word-wrap: break-word;" scope="col"><p class="text-dark ml-lg-4 mr-lg-5" style="font-size: 16px;"><strong>Nominativo</strong></p></th>
                        </tr>
                        <tr>
                            <td style="max-width: 150px; word-wrap: break-word;"><p class="text-dark mr-lg-5" style="font-size: 16px;"><strong>{{$progetto->leader_id['leader_username']}}</strong></p></td>
                            <td style="max-width: 400px; word-wrap: break-word;"><p class="text-dark ml-lg-4 mr-lg-5" style="font-size: 16px;"><strong>{{$progetto->leader_id['leader_name']}}</strong></p></td>
                            <td style="max-width: 300px; word-wrap: break-word;"><p class="text-dark ml-lg-4 mr-lg-5" style="font-size: 16px;"><strong><a href="/profile/{{$progetto->leader_id['leader_id']}}">Visualizza Profilo</a></strong></p></td>
                        </tr>
                        @foreach($progetto->teammates as $teammate)
                            <tr id="teammate_{{$teammate->id}}">
                                <td style="max-width: 150px; word-wrap: break-word;"><p class="text-dark mr-lg-5" style="font-size: 16px;"><strong>{{$teammate->username}}</strong></p></td>
                                <td style="max-width: 400px; word-wrap: break-word;"><p class="text-dark ml-lg-4 mr-lg-5" style="font-size: 16px;"><strong>{{$teammate->name}}</strong></p></td>
                                <td style="max-width: 300px; word-wrap: break-word;"><p class="text-dark ml-lg-4 mr-lg-5" style="font-size: 16px;"><strong><a href="/profile/{{$teammate->id}}">Visualizza Profilo</a></strong></p></td>
                            @can('update', $progetto)
                                @if($progetto->project_end_at === false)
                                    <td><button type="button" id="buttonRimuovi{{$teammate->id}}" class="btn btn-outline-danger" onclick="hideRow('teammate_{{$teammate->id}}', 'hidden{{$teammate->id}}')">Rimuovi</button></td>
                                    <td><input type="text" name="{{$teammate->id}}" hidden="true" style="width: 10%;" id="hidden{{$teammate->id}}" value="0"></td>
                                @endif
                            @endcan
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="modal-footer">
                    @cannot('update', $progetto)
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><strong>Esci</strong></button>
                    @endcan
                    @can('update', $progetto)
                        @if($progetto->project_end_at === false)
                            <input type="submit" value="Conferma rimozione" class="btn btn-warning font-weight-bold">
                        @else
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><strong>Esci</strong></button>
                        @endif
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
