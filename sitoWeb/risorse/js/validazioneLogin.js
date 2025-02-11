function validaLogin(form) {
    let email = form.email.value.trim();
    let password = form.password.value.trim();
    let errorMessage = "";

    if (email === "" || !email.includes("@")) {
        errorMessage += "Inserisci un'email valida.\n";
    }

    if (password === "") {
        errorMessage += "La password non può essere vuota.\n";
    }

    if (errorMessage !== "") {
        alert(errorMessage); // Mostra il messaggio d'errore
        return false; // Blocca l'invio del form
    }

    return true; // Se tutto è valido, permette l'invio del form
}
