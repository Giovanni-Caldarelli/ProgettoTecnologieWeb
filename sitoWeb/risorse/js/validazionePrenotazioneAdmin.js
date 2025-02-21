document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("prenotazione-form").addEventListener("submit", function (event) {
        if (!validaPrenotazione()) {
            event.preventDefault(); 
        }
    });
});

function validaPrenotazione() {
    let nomeUtente = document.querySelector("input[name='nome_utente']").value.trim();
    let dataPrenotazione = document.querySelector("input[name='data_prenotazione']").value;
    let oraPrenotazione = document.querySelector("input[name='ora_prenotazione']").value;
    let oggi = new Date();
    
    if (!nomeUtente || !dataPrenotazione || !oraPrenotazione) {
        alert("Tutti i campi devono essere compilati.");
        return false;
    }

    let dataInserita = new Date(dataPrenotazione + "T" + oraPrenotazione);

    if (dataInserita < oggi.setHours(0, 0, 0, 0)) {
        alert("La data della prenotazione non può essere nel passato.");
        return false;
    }

    return true;
}
