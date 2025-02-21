document.addEventListener("DOMContentLoaded", function () {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            function (position) {
                let latUtente = position.coords.latitude;
                let lonUtente = position.coords.longitude;

                let parcheggi = [
                    { nome: "Centro Storico", indirizzo: "Via Toledo, 123, Napoli" },
                    { nome: "Mergellina", indirizzo: "Via Caracciolo, 45, Napoli" },
                    { nome: "Vomero", indirizzo: "Via Scarlatti, 67, Napoli" }
                ];

                document.querySelectorAll(".parcheggio a").forEach((link, index) => {
                    let destinazione = encodeURIComponent(parcheggi[index].indirizzo);
                    link.href = `https://www.google.com/maps/dir/?api=1&origin=${latUtente},${lonUtente}&destination=${destinazione}`;
                });
            },
            function (error) {
                console.error("Errore nella geolocalizzazione:", error);
            }
        );
    } else {
        console.log("Geolocalizzazione non supportata dal browser.");
    }
});
