document.addEventListener("DOMContentLoaded", function () {
    let auto = document.getElementById("auto");
    let confermaPulsante = document.getElementById("conferma-posto");
    let paymentButton = document.getElementById("submit");

    auto.addEventListener("dragstart", function (event) {
        event.dataTransfer.setData("text", event.target.id);
    });

    function allowDrop(event) {
        event.preventDefault();
    }

    function drop(event) {
        event.preventDefault();
        let posto = event.target;

        if (posto.classList.contains("posto")) {
            let autoElement = document.getElementById(event.dataTransfer.getData("text"));

            // Calcola la posizione centrata
            let offsetX = posto.offsetLeft + (posto.clientWidth / 2) - (autoElement.clientWidth / 2) + 12;
            let offsetY = posto.offsetTop + (posto.clientHeight / 2) - (autoElement.clientHeight / 2);

            autoElement.style.position = "absolute";
            autoElement.style.left = `${offsetX}px`;
            autoElement.style.top = `${offsetY}px`;

            confermaPulsante.removeAttribute("disabled");
            confermaPulsante.setAttribute("data-posto", posto.id);
        }
    }

    document.querySelectorAll(".posto").forEach((posto) => {
        posto.addEventListener("dragover", allowDrop);
        posto.addEventListener("drop", drop);
    });

    confermaPulsante.addEventListener("click", function () {
        let postoSelezionato = confermaPulsante.getAttribute("data-posto");
        if (postoSelezionato) {
            paymentButton.removeAttribute("disabled");
            alert("Posto auto confermato: " + postoSelezionato);
        }
    });
});
