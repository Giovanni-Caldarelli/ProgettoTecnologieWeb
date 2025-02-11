<?php
require_once '../database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["sticky_nome"] = trim($_POST["nome"]);
    $_SESSION["sticky_cognome"] = trim($_POST["cognome"]);
    $_SESSION["sticky_email"] = trim($_POST["email"]);
    
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    // Controllo se le password coincidono
    if ($password1 !== $password2) {
        $_SESSION["errore_registrazione"] = "Errore: Le password non corrispondono.";
        header("Location: login.php");
        exit();
    }

    // Controllo se l'email esiste già nel database
    $query = "SELECT * FROM utenti WHERE email = $1";
    $result = pg_query_params($conn, $query, array($_SESSION["sticky_email"]));

    if ($result && pg_num_rows($result) > 0) {
        $_SESSION["errore_registrazione"] = "L'email è già registrata.";
        header("Location: login.php");
        exit();
    }

    // Inserimento nel database con password criptata
    $password_hash = password_hash($password1, PASSWORD_DEFAULT);
    $query = "INSERT INTO utenti (nome, cognome, email, password) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($conn, $query, array($_SESSION["sticky_nome"], $_SESSION["sticky_cognome"], $_SESSION["sticky_email"], $password_hash));

    if ($result) {
        $_SESSION["successo_registrazione"] = "Registrazione avvenuta con successo!";
        unset($_SESSION["sticky_nome"], $_SESSION["sticky_cognome"], $_SESSION["sticky_email"]);
        header("Location: login.php");
        exit();
    } else {
        $_SESSION["errore_registrazione"] = "Errore durante la registrazione.";
        header("Location: login.php");
        exit();
    }
}
?>

