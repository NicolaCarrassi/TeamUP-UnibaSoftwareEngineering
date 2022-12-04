/**
 * Il metodo permette di visualizzare la descrizione relativa ad un utente,un progetto o un'idea progettuale segnalato/a.
 *
 *
 * @param report_users_id id della segnalazione dell'utente presa in considerazione
 * @param report_projects_id id della segnalazione del progetto o dell'idea progettuale preso/a in considerazione
 * @param competence_id id della competenza presa in considerazione
 */
function showDescription(report_users_id,report_projects_id,competence_id) {

    let deletebtn = document.getElementById('delete_button' + report_projects_id);

    if(deletebtn!==null)
        deletebtn.hidden = !deletebtn.hidden;

    //se entrambi sono -1 sto considerando la descrizione di una competenza
    if(report_users_id===-1 && report_projects_id===-1) {
        let showdescbtn_competence = document.getElementById('showdescbtn_competence' + competence_id);
        let description_competence = document.getElementById('description_competence' + competence_id);

        if (showdescbtn_competence !== null && description_competence !== null) {
            if (description_competence.hidden === true) {
                showdescbtn_competence.innerText = "-";
                description_competence.hidden = false;
            } else {
                showdescbtn_competence.innerText = "+";
                description_competence.hidden = true;
            }
        }
    }

    //se è uguale a -1 sto consederando la descrizione della segnalazione di un utente
    if (report_projects_id === -1) {
        let showdescbtn_user = document.getElementById('showdescbtn_user' + report_users_id);
        let description_user = document.getElementById('description_user' + report_users_id);

        if (showdescbtn_user !== null && description_user !== null) {
            if (description_user.hidden === true) {
                showdescbtn_user.innerText = "-";
                description_user.hidden = false;
            } else {
                showdescbtn_user.innerText = "+";
                description_user.hidden = true;
            }
        }
    }

    //se è uguale a -1 sto consederando la descrizione della segnalazione di un progetto o di un'idea progettuale
    if (report_users_id === -1) {
        let showdescbtn_projects = document.getElementById('showdescbtn_projects' + report_projects_id);
        let description_projects = document.getElementById('description_projects' + report_projects_id);

        if (showdescbtn_projects !== null && description_projects !== null) {
            if (description_projects.hidden === true) {
                showdescbtn_projects.innerText = "-";
                description_projects.hidden = false;
            } else {
                showdescbtn_projects.innerText = "+";
                description_projects.hidden = true;
            }
        }
    }


}

/**
 * Il metodo permette di visualizzare 2 bottoni nascosti: Altre competenze e aggiungi admin
 */
function showHiddenButton() {
    let altrecompetenze = document.getElementById('altrecompetenze');
    let addadmin = document.getElementById('addadmin');

    altrecompetenze.hidden=!altrecompetenze.hidden;
    addadmin.hidden=!addadmin.hidden;
}

/**
 * Il metodo permette di nascondere o mostrare il campo della data di fine
 * se il bottone del ban viene cliccato.
 * Con click dispari il la il campo della data di fine scompare,
 * Con click pari il campo della data di fine viene mostrato
 */
function banUser() {
    let closedatediv = document.getElementById('closedateid');
    let closedate = document.getElementById('closedate');
    let ban = document.getElementById('ban');

    closedatediv.hidden = !closedatediv.hidden;
    closedate.disabled = !closedate.disabled;
    ban.value = closedatediv.hidden;
}

