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
            // ✅ Ora impostiamo `$_SESSION['nome_utente']` come richiesto da `salva_prenotazione.php`
            $_SESSION['user_nome'] = $utente['nome']; 
            $_SESSION['user_email'] = $utente['email'];
            $_SESSION['user_tipo'] = $utente['tipo_utente'];

            if ($utente['tipo_utente'] == 'admin') {
                header("Location: ../gestione/admin.php"); // Reindirizza l'admin alla sua pagina
            } else {
                header("Location: ../homePage/homePage.php"); // Reindirizza gli utenti normali alla homepage
            }
            exit();

        } else {
            $_SESSION["errore_login"] = "Password errata.";
            $_SESSION["sticky_email_login"] = $email;
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION["errore_login"] = "Email errata";
        header("Location: login.php");
        exit();
    }
}
?>
