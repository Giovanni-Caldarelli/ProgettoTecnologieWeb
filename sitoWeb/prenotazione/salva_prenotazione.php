<?php
require 'database.php'; // Connetti al database
session_start();

header('Content-Type: application/json');

// Controlla che l'utente sia loggato
if (!isset($_SESSION["user_id"])) {
    echo json_encode(["error" => "Utente non autenticato"]);
    exit();
}

// Recupera i dati inviati via POST
$id_utente = $_SESSION["user_id"];
$id_parcheggio = $_POST["id_parcheggio"] ?? null;
$data_prenotazione = $_POST["data_prenotazione"] ?? null;
$ora_prenotazione = $_POST["ora_prenotazione"] ?? null;

if (!$id_parcheggio || !$data_prenotazione || !$ora_prenotazione) {
    echo json_encode(["error" => "Dati mancanti"]);
    exit();
}

try {
    // Controlla la connessione al database
    if (!$conn) {
        echo json_encode(["error" => "Connessione al database fallita"]);
        exit();
    }

    // Salva la prenotazione nel database
    $query = "INSERT INTO prenotazioni (id_utente, id_parcheggio, data_prenotazione, ora_prenotazione) VALUES ($1, $2, $3, $4) RETURNING id";
    $result = pg_query_params($conn, $query, [$id_utente, $id_parcheggio, $data_prenotazione, $ora_prenotazione]);

    if (!$result) {
        throw new Exception("Errore nel salvataggio della prenotazione.");
    }

    $id_prenotazione = pg_fetch_result($result, 0, "id");

    // Aggiorna i posti disponibili nel parcheggio
    $update_query = "UPDATE parcheggi SET posti_disponibili = posti_disponibili - 1 WHERE id = $1";
    pg_query_params($conn, $update_query, [$id_parcheggio]);

    // Restituisce l'ID della prenotazione per il reindirizzamento
    echo json_encode(['success' => true, 'redirect' => "area_privata.php?id=$id_prenotazione"]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
