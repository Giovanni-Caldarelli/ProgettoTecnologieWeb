<?php
require_once '../database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION["sticky_nome"] = trim($_POST["nome"]);
    $_SESSION["sticky_cognome"] = trim($_POST["cognome"]);
    $_SESSION["sticky_email"] = trim($_POST["email"]);
    
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    if ($password1 !== $password2) {
        $_SESSION["errore_registrazione"] = "Errore: Le password non corrispondono.";
        header("Location: login.php");
        exit();
    }


    $query_email = "SELECT * FROM utenti WHERE email = $1";
    $result_email = pg_query_params($conn, $query_email, array($_SESSION["sticky_email"]));
    if ($result_email && pg_num_rows($result_email) > 0) {
        $_SESSION["errore_registrazione"] = "L'email è già registrata.";
        header("Location: login.php");
        exit();
    }
    $query_nome = "SELECT * FROM utenti WHERE nome = $1";
    $result_nome = pg_query_params($conn, $query_nome, array($_SESSION["sticky_nome"]));

    if ($result_nome && pg_num_rows($result_nome) > 0) {
        $_SESSION["errore_registrazione"] = "Questo nome utente è già in uso. Scegli un altro nome.";
        header("Location: login.php");
        exit();
    }

    
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
