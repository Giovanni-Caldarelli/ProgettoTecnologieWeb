<?php
session_start();
require '../database.php'; // Connessione al database

// Controllo se l'utente è loggato
if (!isset($_SESSION['user_nome'])) {
    die(json_encode(['success' => false, 'error' => 'Utente non autenticato']));
}

$nome_utente = $_SESSION['user_nome'];

// Controllo se i dati sono stati inviati
if (!isset($_POST['nome_parcheggio'], $_POST['data_prenotazione'], $_POST['ora_prenotazione'])) {
    die(json_encode(['success' => false, 'error' => 'Dati mancanti']));
}

$nome_parcheggio = $_POST['nome_parcheggio'];
$data_prenotazione = $_POST['data_prenotazione'];
$ora_prenotazione = $_POST['ora_prenotazione'];

// Inseriamo la prenotazione nel database
$query = "INSERT INTO prenotazioni (nome_utente, nome_parcheggio, data_prenotazione, ora_prenotazione) 
          VALUES ($1, $2, $3, $4) RETURNING id";
$result = pg_query_params($conn, $query, [$nome_utente, $nome_parcheggio, $data_prenotazione, $ora_prenotazione]);

if (!$result) {
    die(json_encode(['success' => false, 'error' => pg_last_error($conn)]));
}

// Otteniamo l'ID della prenotazione appena creata
$prenotazione = pg_fetch_assoc($result);

// Rispondiamo con un JSON valido per il JavaScript
echo json_encode(['success' => true, 'redirect' => 'area_riservata.php?id=' . $prenotazione['id']]);
?>
