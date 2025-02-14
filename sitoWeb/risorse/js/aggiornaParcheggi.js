document.addEventListener("DOMContentLoaded", function () {
    function aggiornaParcheggi() {
        let xhr = new XMLHttpRequest();
        xhr.open("GET", window.location.href, true); // Richiama la stessa pagina PHP
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest"); // Per distinguere richiesta AJAX

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let parser = new DOMParser();
                let doc = parser.parseFromString(xhr.responseText, "text/html");
                let parcheggiAggiornati = doc.getElementById("lista-parcheggi").innerHTML;

                document.getElementById("lista-parcheggi").innerHTML = parcheggiAggiornati;
            }
        };
        xhr.send(); // Invia la richiesta
    }

    // Aggiorna ogni 5 secondi
    setInterval(aggiornaParcheggi, 5000);

    // Esegui subito al caricamento della pagina
    aggiornaParcheggi();
});