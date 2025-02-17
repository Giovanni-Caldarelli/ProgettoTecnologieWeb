<?php
require_once '../database.php'; 

header('Content-Type: application/json');

$query = "SELECT nome, posti_disponibili FROM parcheggi";
$result = pg_query($conn, $query);

echo json_encode(pg_fetch_all($result) ?: []); // Conversione diretta in JSON
?>
