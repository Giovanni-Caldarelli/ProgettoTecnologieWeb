<?php
// Dati di connessione al database
$host = "localhost";      // Server locale
$port = "5432";           // Porta di default di PostgreSQL
$dbname = "gruppo17";           // Nome del database (in questo caso TW)
$user = "www";            // Utente richiesto dal professore
$password = "tw2024";     // Password indicata dal professore

try {
    // Creazione della connessione
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Messaggio di successo
    echo "✅ Connessione riuscita al database '$dbname'!";
} catch (PDOException $e) {
    // Errore di connessione
    echo "❌ Errore di connessione: " . $e->getMessage();
}
?>

