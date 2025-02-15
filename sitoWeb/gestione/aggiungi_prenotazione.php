<?php
session_start();
require_once '../database.php';

if ($_SESSION['user_tipo'] !== 'admin') {
    header("Location: ../homePage/homePage.php");
    exit();
}

if (!empty($_POST['nome_utente']) && !empty($_POST['nome_parcheggio']) && !empty($_POST['data_prenotazione']) && !empty($_POST['ora_prenotazione'])) {
    $query = "INSERT INTO prenotazioni (nome_utente, nome_parcheggio, data_prenotazione, ora_prenotazione) VALUES ($1, $2, $3, $4)";
    pg_query_params($conn, $query, [
        $_POST['nome_utente'],
        $_POST['nome_parcheggio'],
        $_POST['data_prenotazione'],
        $_POST['ora_prenotazione']
    ]);
}

header("Location: admin.php");
exit();
