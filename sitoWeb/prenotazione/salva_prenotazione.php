<?php
session_start();
require '../database.php'; 

if (!isset($_SESSION['user_nome'])) {
    die(json_encode(['success' => false, 'error' => 'Utente non autenticato']));
}
$nome_utente = $_SESSION['user_nome'];

if (!isset($_POST['nome_parcheggio'], $_POST['data_prenotazione'], $_POST['ora_prenotazione'])) {
    die(json_encode(['success' => false, 'error' => 'Dati mancanti']));
}

$nome_parcheggio = $_POST['nome_parcheggio'];
$data_prenotazione = $_POST['data_prenotazione'];
$ora_prenotazione = $_POST['ora_prenotazione'];

$query_posti = "SELECT posti_disponibili FROM parcheggi WHERE nome = $1";
$result_posti = pg_query_params($conn, $query_posti, [$nome_parcheggio]);
$row = pg_fetch_assoc($result_posti);

if (!$row || $row['posti_disponibili'] <= 0) {
    die(json_encode(['success' => false, 'error' => 'Posti esauriti o parcheggio inesistente']));
}

$query_prenotazione = "INSERT INTO prenotazioni (nome_utente, nome_parcheggio, data_prenotazione, ora_prenotazione) 
                       VALUES ($1, $2, $3, $4)";
$result_prenotazione = pg_query_params($conn, $query_prenotazione, [$nome_utente, $nome_parcheggio, $data_prenotazione, $ora_prenotazione]);

if (!$result_prenotazione) {
    die(json_encode(['success' => false, 'error' => 'Errore nel salvataggio della prenotazione']));
}

$query_update = "UPDATE parcheggi SET posti_disponibili = posti_disponibili - 1 WHERE nome = $1";
pg_query_params($conn, $query_update, [$nome_parcheggio]);

echo json_encode(['success' => true, 'redirect' => '../profilo/area_riservata.php']);
?>
