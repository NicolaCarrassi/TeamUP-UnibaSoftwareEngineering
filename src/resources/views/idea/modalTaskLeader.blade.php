<div id="inserisciCompiti" class="modal fade" tabindex="-1" role="dialog" style="margin-top: 5%;" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8b323">
                <h5 id="tasksHeader" class="modal-title"><strong>Inserisci compito</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('addNewTask', $progetto->id)}}">
                @csrf
                <div class="modal-body" style="overflow-x: hidden; overflow-y: auto; max-height: 400px;">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <textarea id="description" maxlength="300" rows="5" style="resize:none;"
                                      class="form-control @error('description') is-invalid @enderror"
                                      name="description" placeholder="Descrizione del compito" required autocomplete="description">{{ old('description') }}</textarea>

                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <select id="task_to_user" name="task_to_user"
                                    class="form-control @error('task_to_user') is-invalid @enderror"
                                    required autocomplete="task_to_user" autofocus>
                                @if(old('task_to_user') === null)
                                    <option value="" disabled selected hidden> -- seleziona a chi assegnare il compito -- </option>
                                    <option value="{{$progetto->leader_id['leader_username']}}">{{$progetto->leader_id['leader_username']}}</option>
                                    @foreach($progetto->teammates as $teammate)
                                        <option value="{{$teammate->username}}"> {{$teammate->username}}</option>
                                    @endforeach
                                @else
                                    <option value="{{old('task_to_user')}}" selected> {{old('task_to_user')}} </option>
                                    @if($progetto->leader_id['leader_username'] !== old('task_to_user'))
                                        <option value="{{$progetto->leader_id['leader_username']}}">{{$progetto->leader_id['leader_username']}}</option>
                                    @endif
                                    @foreach($progetto->teammates as $teammate)
                                        @if($teammate->username !== old('task_to_user'))
                                            <option value="{{$teammate->username}}"> {{$teammate->username}} </option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>

                            @error('task_to_user')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Aggiungi" class="btn btn-warning font-weight-bold">
                </div>
            </form>
        </div>
    </div>
</div>
