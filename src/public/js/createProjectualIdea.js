/** Metodo che si occupa di evitare che l'utente possa specificare la necessità di incontro senza la specifica
 *  della città nel form di creazione dell'idea. Esso si occupa pertanto di verificare che tali informazioni
 *  vadano sempre in coppia
 *
 * @returns {boolean} true se sono settati in coppia, false altrimenti
 */
function controlNeedToMeetAndCity(){
    let needToMeet=document.getElementById('needToMeet').checked
    let city=document.getElementById('citta');
    let selected=city.options[city.selectedIndex].value
    if((needToMeet === true && selected !=='Seleziona una città...') || (needToMeet !== true && selected === 'Seleziona una città...'))
        return true
    else {
        alert('Necessità di incontro e città devono essere specificati assieme!')
        return false
    }
}

/** Metodo che si occupa di visualizzare/nascondere nel form di creazione di un'idea tutte le informazioni
 *  facoltative di un'idea progettuale
 *
 * @returns {boolean} true se visualizzato, false altrimenti
 */
function showOption(){
    return document.getElementById('myOption').hidden = !(document.getElementById('toggleShowMore').checked)
}
