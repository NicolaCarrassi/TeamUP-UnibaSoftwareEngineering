/** Metodo che permette di visualizzare il modal contenente l'elenco dei partecipanti all'idea/progetto
 *
 */
function showAllPartecipants(){
    $(document).ready(function () {
        $('#visualizzaTuttiPartecipanti').modal();
        navbar.hidden = true;
        $('#visualizzaTuttiPartecipanti').click(function () {
            navbar.hidden = false;
        });
    });
}

/** Metodo che permette di visualizzare il modal contenente l'elenco delle richieste di partecipazione all'idea/progetto
 *  da parte del leader
 *
 */
function showAllRequests(){
    $(document).ready(function () {
        $('#visualizzaRichieste').modal();
        navbar.hidden = true;
        $('#visualizzaRichieste').click(function () {
            navbar.hidden = false;
        });
    });
}

/** Metodo che permette di visualizzare il modal contenente l'elenco dei compiti associati ad un progetto
 *
 */
function showAllTasks(){
    $(document).ready(function () {
        $('#typeModalTable').prop('innerText','0');
        $('#visualizzaCompiti').modal();
        navbar.hidden = true;
        $('#visualizzaCompiti').click(function () {
            navbar.hidden = false;
        });
    });
}

/** Metodo che permette di visualizzare il modal contenente l'elenco degli aggiornamenti associati ad un progetto
 *
 */
function showAllFeeds(){
    $(document).ready(function () {
        $('#typeModalTable').prop('innerText','1');
        $('#visualizzaFeeds').modal();
        navbar.hidden = true;
        $('#visualizzaFeeds').click(function () {
            navbar.hidden = false;
        });
    });
}

/** Metodo che permette di visualizzare il modal mediante il quale poter assegnare un nuovo compito nel progetto
 *
 */
function showAddNewTask(){
    $(document).ready(function () {
        $('#inserisciCompiti').modal();
        navbar.hidden = true;
        $('#inserisciCompiti').click(function () {
            navbar.hidden = false;
        });
    });
}

/** Metodo che consente di nascondere i bottoni di accettazione/rifiuto della richieste nel corrispondente modal
 *  nel momento in cui il leader setta l'esito della richiesta, modificando anche il colore del cerchio visualizzato
 *
 * @param idBottoneAccetta id del bottone di accettazione
 * @param idBottoneRifiuta id del bottone di rifiuto
 * @param hiddenInput id del campo nascosto contenente l'esito della richiesta
 * @param esito esito della richiesta da memorizzare
 * @param cerchioStato id del cerchio circa lo stato della richiesta
 */
function setEsitoRichiesta(idBottoneAccetta, idBottoneRifiuta, hiddenInput, esito, cerchioStato){
    let hidden = document.getElementById(hiddenInput)
    let buttonAccetta = document.getElementById(idBottoneAccetta)
    let buttonRifiuta = document.getElementById(idBottoneRifiuta)
    let stato = document.getElementById(cerchioStato)
    stato.classList.remove('circleYellow')
    if(esito === 1){
        stato.classList.add('circleGreen')
    }else{
        stato.classList.add('circleRed')
    }
    buttonAccetta.hidden = true
    buttonRifiuta.hidden = true
    //hidden.value = esito
    hidden.setAttribute('value', esito)
}

/** Metodo che consente di annullare le modifiche effettuate nel modal di accettazione/rifiuto delle richieste
 *  nel momento in cui il leader non conferma le modifiche apportate e chiude il modal
 *
 */
function restoreTableRequestLeader(){
    let table = document.getElementById('table_requests')
    if(table !== null) {
        for (let i = 0; i < table.rows.length; i++) {
            if ($('#table_requests tbody tr:eq(' + i + ') td:eq(6) input').val() != undefined) {
                let riga = table.getElementsByTagName('tr')[i]
                let hidden = riga.getElementsByTagName('INPUT')
                let id = hidden[0].getAttribute('id')
                hidden = document.getElementById(id)
                hidden.setAttribute('value', 0)
                let buttonAccetta = document.getElementById('buttonAccetta' + id)
                let buttonRifiuta = document.getElementById('buttonRifiuta' + id)
                buttonAccetta.hidden = false
                buttonRifiuta.hidden = false
                let cerchioStato = document.getElementById('cerchioStato' + id)
                cerchioStato.classList.remove('circleRed')
                cerchioStato.classList.remove('circleGreen')
                cerchioStato.classList.add('circleYellow')
            }
        }
    }
}

/** Metodo che consente di nascondere una riga della tabella contenente i partecipanti al team
 *
 * @param idRow id della riga da nascondere
 * @param hiddenInput id del campo nascosto contenente 1 nel caso il leader intenda rimuovere il teammate, 0 altrimenti
 */
function hideRow(idRow, hiddenInput){
    let hidden = document.getElementById(hiddenInput)
    hidden.setAttribute('value', 1)
    let row = document.getElementById(idRow)
    row.hidden = true;
}


/** Metodo che consente di annullare le modifiche effettuate nel modal di visualizzazione dei teammate del progetto
 *  nel momento in cui il leader non conferma le modifiche apportate e chiude il modal
 *
 * @param idTable id della table di cui fare il restore
 */
function restoreTableTeam(idTable){
    let table = document.getElementById(idTable)
    for(let i = 0; i < table.rows.length; i++){
        if(table.rows[i].hidden === true){
            let riga = table.getElementsByTagName('tr')[i]
            let hidden = riga.getElementsByTagName('INPUT')
            let id = hidden[0].getAttribute('id')
            hidden = document.getElementById(id)
            hidden.setAttribute('value', 0)
            table.rows[i].hidden = false;
        }
    }
}

//alla chiusura del modal di visualizzazione di tutti i partecipanti esegue il metodo restoreTableTeam
$("#visualizzaTuttiPartecipanti").on("hidden.bs.modal", function () {
    restoreTableTeam('table_membri_team');
})

//alla chiusura del modal di visualizzazione di tutte le richieste esegue il metodo restoreTableRequestLeader
$("#visualizzaRichieste").on("hidden.bs.modal", function () {
    restoreTableRequestLeader();
})


