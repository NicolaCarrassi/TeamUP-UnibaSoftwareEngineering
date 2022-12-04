<div class="container">
    <table id="tasks" name="tasks" class="table-responsive">
        <caption>Compiti</caption>
        <tr>
            <th style="max-width: 200px; word-wrap: break-word;" scope="col"><p class="text-dark mr-lg-5" style="font-size: 16px;"><strong>Username</strong></p></th>
            <th style="max-width: 340px; word-wrap: break-word;"scope="col"><p class="text-dark ml-lg-4 mr-lg-5" style="font-size: 16px;"><strong>Descrizione</strong></p></th>
            <th style="max-width: 300px; word-wrap: break-word;"scope="col"><p class="text-dark ml-lg-4 mr-lg-5" style="font-size: 16px;"><strong>Data Assegnamento</strong></p></th>
        </tr>
        @foreach($compiti as $compito)
            <tr>
                <td style="max-width: 200px; word-wrap: break-word;"><p class="text-dark mr-lg-5" style="font-size: 16px;"><strong>{{$compito->username}}</strong></p></td>
                <td style="max-width: 340px; word-wrap: break-word;"><details class="ml-lg-4 mr-lg-5"><p class="text-dark" style="font-size: 16px;">{{$compito->description}}</p></details></td>
                <td style="max-width: 300px; word-wrap: break-word;"><p class="text-dark ml-lg-4 mr-lg-5" style="font-size: 16px;"><strong>{{substr($compito->assignment_date, 0, strlen($compito->assignment_date)-3)}}</p></td>
            </tr>
        @endforeach
    </table>
    <div class="bottone-paginazione d-flex" style="margin-top: -10%; margin-left: 40%; .bottone-paginazione > nav {
            position: relative;
            z-index: 0;
        }">
        {!! $compiti->links() !!}
    </div>
</div>
