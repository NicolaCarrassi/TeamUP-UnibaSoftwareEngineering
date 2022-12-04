/**
 * Il metodo permette di visualizzare un finestra di conferma per una determinata azione.
 *
 * @param button id del bottone cliccato
 * @param header il testo presente nel titolo della finestra
 * @param body il testo presente nel corpo della finestra
 */
function showConfirmModal(button,header,body) {
    $(document).ready(function () {
        $('#confdial').modal();
        let confirmheader = document.getElementById('confirmheader');
        let confirmbody = document.getElementById('confirmbody');
        let confirmroute = document.getElementById('confirmroute');
        let button_clicked = document.getElementById(button);


        confirmheader.innerText = header;
        confirmbody.innerText = replaceAll(body,"_","'");
        confirmroute.href = button_clicked.value;
    });
}

/**
 * Il metodo permette di rimpiazzare una porzione di una stringa,
 * sostituendola con il contenuto di un'altra stringa,
 * e restituendola successivamente
 *
 * @param str
 * @param cerca
 * @param sostituisci
 * @returns {string}
 */
function replaceAll(str, cerca, sostituisci) {
    return str.split(cerca).join(sostituisci);
}

/**
 * Il metodo permette di visualizzare la finestra per la modifica della password di un utente
 */
function startPasswordUpdateModal(){
    $(document).ready(function(){
        $('#updatePasswordModal').modal();

    })
}
