<?php
session_start();
require_once '../database.php';

// Controllo se l'utente è un admin
if ($_SESSION['user_tipo'] !== 'admin') {
    die("Accesso negato. Non sei un amministratore.");
}

$query_centro_storico = "SELECT nome_utente, data_prenotazione, ora_prenotazione FROM prenotazioni WHERE nome_parcheggio = 'Centro Storico' ORDER BY data_prenotazione DESC";
$query_mergellina = "SELECT nome_utente, data_prenotazione, ora_prenotazione FROM prenotazioni WHERE nome_parcheggio = 'Mergellina' ORDER BY data_prenotazione DESC";
$query_vomero = "SELECT nome_utente, data_prenotazione, ora_prenotazione FROM prenotazioni WHERE nome_parcheggio = 'Vomero' ORDER BY data_prenotazione DESC";

$result_centro_storico = pg_query($conn, $query_centro_storico);
$result_mergellina = pg_query($conn, $query_mergellina);
$result_vomero = pg_query($conn, $query_vomero);

$prenotazioni_centro_storico = pg_fetch_all($result_centro_storico) ?: [];
$prenotazioni_mergellina = pg_fetch_all($result_mergellina) ?: [];
$prenotazioni_vomero = pg_fetch_all($result_vomero) ?: [];

$parcheggi = [
    "Centro Storico" => $prenotazioni_centro_storico,
    "Mergellina" => $prenotazioni_mergellina,
    "Vomero" => $prenotazioni_vomero
];
?>





<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>FastPark - Admin</title>
    <meta name="generator" content="Visual Studio Code">
    <meta name="author" content="Giovanni Caldarelli">
    <link rel="stylesheet" href="../risorse/css/styleAdmin.css"> 
    <link rel="icon" href="../risorse/immagini/logoP.png" type="image/png">
</head>



<body>

    <header>
        <div class="logo">
            <a href="../homePage/homePage.php"> 
                <img src="../risorse/immagini/logo.png" alt="FastPark Logo">
            </a>
            <h1>FastPark</h1>
        </div>
        <nav>
            <ul>
                <li><a href="../homePage/homePage.php">Home</a></li>
            </ul>
        </nav>
    </header>

    <main> 
        <h1>Dashboard Admin</h1>

        <h2>Aggiungi una nuova prenotazione</h2>
        <form action="aggiungi_prenotazione.php" method="POST">
            <label>Nome Utente:</label>
            <input type="text" name="nome_utente" required>

            <label>Parcheggio:</label>
            <select name="nome_parcheggio" required>
                <?php
                foreach ($parcheggi as $nome_parcheggio => $prenotazioni) {
                    echo "<option value='$nome_parcheggio'>$nome_parcheggio</option>";
                }
               ?>
            </select>

            <label>Data:</label>
            <input type="date" name="data_prenotazione" required>

            <label>Ora:</label>
            <input type="time" name="ora_prenotazione" required>

            <button type="submit">Aggiungi Prenotazione</button>
        </form>

        <?php
        foreach ($parcheggi as $nome_parcheggio => $lista_prenotazioni) {
            echo "<h2>$nome_parcheggio</h2>";
            echo "<table>
                <tr>
                    <th>Nome Utente</th>
                    <th>Data</th>
                    <th>Ora</th>
                    <th>Azioni</th>
                </tr>";

            if (!empty($lista_prenotazioni)) {
                foreach ($lista_prenotazioni as $prenotazione) {
                    echo "<tr>
                        <td>" . htmlspecialchars($prenotazione['nome_utente']) . "</td>
                        <td>" . htmlspecialchars($prenotazione['data_prenotazione']) . "</td>
                        <td>" . htmlspecialchars($prenotazione['ora_prenotazione']) . "</td>
                        <td>
                            <a href='rimuovi_prenotazione.php?utente=" . urlencode($prenotazione['nome_utente']) . "&parcheggio=" . urlencode($nome_parcheggio) . "&data=" . urlencode($prenotazione['data_prenotazione']) . "&ora=" . urlencode($prenotazione['ora_prenotazione']) . "'>❌ Elimina</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nessuna prenotazione trovata.</td></tr>";
            }

            echo "</table>";
        }
        ?>
</body>
</html>
