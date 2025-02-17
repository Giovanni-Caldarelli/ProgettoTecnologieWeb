document.addEventListener("DOMContentLoaded", function () {
    function aggiornaParcheggi() {
        fetch("../homePage/aggiorna_parcheggi.php") // Usa fetch invece di XMLHttpRequest
            .then(response => response.json()) // Converte direttamente in JSON
            .then(parcheggi => {
                let lista = document.getElementById("lista-parcheggi");
                lista.innerHTML = parcheggi.map(p => `<li>${p.nome}: ${p.posti_disponibili} posti disponibili</li>`).join("");
            })
            .catch(error => console.error("Errore aggiornamento parcheggi:", error));
    }

    setInterval(aggiornaParcheggi, 5000); // Aggiorna ogni 5 secondi
    aggiornaParcheggi(); // Aggiorna subito al caricamento
});
