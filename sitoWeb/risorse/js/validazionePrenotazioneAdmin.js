document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("prenotazione-form").addEventListener("submit", function (event) {
        if (!validaPrenotazione()) {
            event.preventDefault(); // Blocca l'invio del modulo se non valido
        }
    });
});

function validaPrenotazione() {
    let nomeUtente = document.querySelector("input[name='nome_utente']").value.trim();
    let dataPrenotazione = document.querySelector("input[name='data_prenotazione']").value;
    let oraPrenotazione = document.querySelector("input[name='ora_prenotazione']").value;
    let oggi = new Date();
    
    // Validazione campi vuoti
    if (!nomeUtente || !dataPrenotazione || !oraPrenotazione) {
        alert("Tutti i campi devono essere compilati.");
        return false;
    }

    // Converte la data in oggetto Date
    let dataInserita = new Date(dataPrenotazione + "T" + oraPrenotazione);

    // Controllo che la data non sia nel passato
    if (dataInserita < oggi.setHours(0, 0, 0, 0)) {
        alert("La data della prenotazione non può essere nel passato.");
        return false;
    }

    return true;
}
