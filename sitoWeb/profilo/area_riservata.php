<?php
session_start();
require '../database.php'; // Connessione al database

// Controllo se l'utente è loggato
if (!isset($_SESSION['user_nome'])) {
    header("Location: login.php");
    exit();
}

$user_nome = $_SESSION['user_nome'];


// Recupera tutte le prenotazioni dell'utente
$query = "SELECT * FROM prenotazioni WHERE nome_utente = $1 ORDER BY id DESC";
$result = pg_query_params($conn, $query, [$user_nome]);

$prenotazioni = pg_fetch_all($result);
?>







<!DOCTYPE html>
<html lang="it">
<head>
    <title>FastPark - Area Riservata</title>
    <meta charset="UTF-8">
    <meta name="generator" content="Visual Studio Code">
    <meta name="keywords" content="parcheggio, auto, fastpark, sosta, sicurezza, prenotazione online, centro città,area rsìiservata">
    <meta name="author" content="Giovanni Caldarelli">
    <meta name="description" content="FastPark - Area riservata.">
    <link rel="icon" href="../risorse/immagini/logoP.png" type="image/png">
    <link rel="stylesheet" href="../risorse/css/styleAreaRiservata.css">
</head>
<body>
    <header>
        <div class="logo">
            <a href="../homePage/homePage.php"> 
                <img src="../risorse/immagini/logo.png" alt="FastPark Logo">
            </a>
            <h1>FastPark </h1>
        </div>
        <nav>
            <ul>
                <li><a href="../homePage/homePage.php">Home</a></li>
                <li><a href="../homePage/homePage.php#contatti">Contatti</a></li>
                <li><a href="../homePage/homePage.php#tariffe">Tariffe</a></li>
                <li><a href="../homePage/homePage.php#come-funziona">Come Funziona</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <h2>Benvenuto <?php echo htmlspecialchars($user_nome); ?>, questa è la tua area riservata  </h2>
        <br>
        <section id="prenotazioni">
            <h3>Le tue prenotazioni</h3>
            <?php
            if ($prenotazioni) {
                echo '<div class="lista-prenotazioni">';
                foreach ($prenotazioni as $prenotazione) {
                    echo '<div class="prenotazione">';
                    echo '<p><strong>Parcheggio:</strong> ' . htmlspecialchars($prenotazione['nome_parcheggio']) . '</p>';
                    echo '<p><strong>Data:</strong> ' . htmlspecialchars($prenotazione['data_prenotazione']) . '</p>';
                    echo '<p><strong>Ora:</strong> ' . htmlspecialchars($prenotazione['ora_prenotazione']) . '</p>';
                    echo '</div>';
                }
                echo '</div>';
                } else {
                     echo '<p>Non hai ancora effettuato prenotazioni.</p>';
                }
            ?>
        </section>
    </main>
</body>
</html>







