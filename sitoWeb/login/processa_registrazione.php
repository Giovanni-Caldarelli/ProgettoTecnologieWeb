<?php
require_once '../database.php'; // Connessione al database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST["nome"]);
    $cognome = trim($_POST["cognome"]);
    $email = trim($_POST["email"]);
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];
    
    // Controllo se le password coincidono
    if ($password1 !== $password2) {
        echo "Errore: Le password non corrispondono.";
        exit();
    }

    // Controllo se l'email esiste già nel database
    $query = "SELECT * FROM utenti WHERE email = $1";
    $result = pg_query_params($conn, $query, array($email));

    if (pg_num_rows($result) > 0) {
        echo "Errore: L'email è già registrata.";
        exit();
    }

    // Inserimento nel database con password criptata
    $password_hash = password_hash($password1, PASSWORD_DEFAULT);
    $query = "INSERT INTO utenti (nome, cognome, email, password) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($conn, $query, array($nome, $cognome, $email, $password_hash));

    if ($result) {
        echo "Registrazione avvenuta con successo! <a href='login.php'>Accedi</a>";
    } else {
        echo "Errore durante la registrazione.";
    }
}
?>
