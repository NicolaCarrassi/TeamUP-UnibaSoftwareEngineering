/**
 * Il metodo permette di cambiare la label associata all'immagine, rendendo essa uguale
 * al nome dell'immagine caricata dall'utente
 */
function cambioImmagine(idImageInput){
    let avatar = document.getElementById(idImageInput);
    let nomeFile = $(avatar).val().split("\\").pop();
    document.getElementById("labelImmagine").textContent = nomeFile;
}
