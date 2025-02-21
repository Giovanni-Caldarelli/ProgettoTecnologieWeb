document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("prenotazione-form").addEventListener("submit", function (event) {
        if (!validaPrenotazione()) {
            event.preventDefault(); 
        }
    });
});

function validaPrenotazione() {
    let checkIn = document.getElementById("check-in").value;
    let checkOut = document.getElementById("check-out").value;
    let checkInTime = document.getElementById("check-in-time").value;
    let checkOutTime = document.getElementById("check-out-time").value;

    if (!checkIn || !checkOut || !checkInTime || !checkOutTime) {
        alert("Tutti i campi devono essere compilati.");
        return false;
    }
    let dataCheckIn = new Date(checkIn + "T" + checkInTime);
    let dataCheckOut = new Date(checkOut + "T" + checkOutTime);
    let oggi = new Date();

    if (dataCheckIn < oggi.setHours(0, 0, 0, 0)) {
        alert("La data di check-in non può essere nel passato.");
        return false;
    }

    if (dataCheckOut <= dataCheckIn) {
        alert("La data di check-out deve essere successiva al check-in.");
        return false;
    }
    return true;
}





