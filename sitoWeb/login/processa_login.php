<?php
session_start();
require_once '../database.php'; // Connessione al database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $query = "SELECT * FROM utenti WHERE email = $1";
    $result = pg_query_params($conn, $query, array($email));

    if ($result && pg_num_rows($result) > 0) {
        $utente = pg_fetch_assoc($result);
        
        if (password_verify($password, $utente['password'])) {
            $_SESSION['user_email'] = $utente['email'];
            $_SESSION['user_nome'] = $utente['nome'];
            $_SESSION['user_tipo'] = $utente['tipo_utente'];
            header("Location: ../homePage/homePage.php");
            exit();
        } else {
            echo "Errore: Password errata.";
        }
    } else {
        echo "Errore: Nessun account trovato con questa email.";
    }
}
?>
