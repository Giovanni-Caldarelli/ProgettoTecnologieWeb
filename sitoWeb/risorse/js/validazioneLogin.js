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
        alert(errorMessage); 
        return false; 
    }
    return true; 
}



