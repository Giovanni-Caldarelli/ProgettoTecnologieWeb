<?php
session_start();
require_once '../database.php';

if ($_SESSION['user_tipo'] !== 'admin' || empty($_GET['utente']) || empty($_GET['parcheggio']) || empty($_GET['data']) || empty($_GET['ora'])) {
    header("Location: ../homePage/homePage.php");
    exit();
}

$query = "DELETE FROM prenotazioni WHERE nome_utente = $1 AND nome_parcheggio = $2 AND data_prenotazione = $3 AND ora_prenotazione = $4";
pg_query_params($conn, $query, [$_GET['utente'], $_GET['parcheggio'], $_GET['data'], $_GET['ora']]);

header("Location: admin.php");
exit();
?>