@extends('profileview.profiletemp')

@section('content')
    @parent
    <div class="col"  style="margin-left: 25%; width: 70%;">
        <div class="row" style="width: 30%;">
            <h1>Profilo Utente</h1>
        </div>
        <div class="row" style="margin-top: 12%;">
            <p class="text-dark" style="font-size: 20px;">Username: <strong><br>{{$user->username}}</strong></p>
            <p class="text-dark" style="font-size: 20px; margin-left: 5%;">E-mail: <strong><br>{{$user->email}}</strong></p>
            <p class="text-dark" style="font-size: 20px; margin-left: 5%;">Nome: <strong><br>{{$user->name}}</strong></p>
            @if($user->birth_date != null)
                <p class="text-dark" style="font-size: 20px; margin-left: 5%;">Data di nascita: <strong><br>{{$user->birth_date}}</strong></p>
            @endif
            @if($user->city != null)
                <p class="text-dark" style="font-size: 20px; margin-left: 5%;">Citta: <strong><br>{{$user->city}}</strong></p>
            @endif
        </div>
        <div class="row" style="width: 30%; margin-top: 1%;">
            <p class="text-dark" style="font-size: 20px;">Competenze:</p>
            <table class="table table-bordered">
                <caption></caption>
                <thead>
                <tr>
                    <th scope="col">Competenza</th>
                    <th scope="col">Livello</th>
                </tr>
                </thead>
                <tbody>
                @foreach($competenze as $competenza)
                    <tr>
                        <td>{{$competenza->competence}}</td>
                        @switch($competenza->level)
                            @case(1)
                            <td>Scarsa</td>
                            @break
                            @case(2)
                            <td>Intermedia</td>
                            @break
                            @default
                            <td>Avanzata</td>
                            @break
                        @endswitch
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

