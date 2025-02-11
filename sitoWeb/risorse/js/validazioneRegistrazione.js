function validaRegistrazione(form) {
    let nome = form.nome.value.trim();
    let cognome = form.cognome.value.trim();
    let email = form.email.value.trim();
    let password1 = form.password1.value;
    let password2 = form.password2.value;
    let errorMsg = "";

    // Controllo che i campi non siano vuoti
    if (nome === "") {
        errorMsg += "Il nome è obbligatorio.\n";
        form.nome.focus();
    } else if (nome.includes("@") || nome.includes("!")) {
        errorMsg += "Il nome non può contenere '@' o caratteri speciali.\n";
        form.nome.focus();
    }

    if (cognome === "") {
        errorMsg += "Il cognome è obbligatorio.\n";
        form.cognome.focus();
    }

    if (email === "" || email.indexOf("@") === -1) {
        errorMsg += "Inserisci un'email valida.\n";
        form.email.focus();
    }

    if (password1 === "") {
        errorMsg += "La password è obbligatoria.\n";
        form.password1.focus();
    } else if (password1.length < 6) {
        errorMsg += "La password deve contenere almeno 6 caratteri.\n";
        form.password1.focus();
    }

    if (password1 !== password2) {
        errorMsg += "Le due password non corrispondono.\n";
        form.password1.focus();
    }

    // Se ci sono errori, mostriamo un alert e blocchiamo l'invio
    if (errorMsg !== "") {
        alert(errorMsg);
        return false;
    }

    return true; // Permette l'invio del modulo
}
