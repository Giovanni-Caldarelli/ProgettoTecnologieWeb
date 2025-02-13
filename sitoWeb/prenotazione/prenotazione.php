<?php
session_start();

// Se il form non è stato inviato, reindirizza alla homepage
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../homePage.php");
    exit();
}

// Recupero dati dal form
$sede = $_POST['sede'];
$checkIn = $_POST['check-in'];
$checkOut = $_POST['check-out'];
$checkInTime = $_POST['check-in-time'];
$checkOutTime = $_POST['check-out-time'];

// Converte le date e calcola la durata in ore
$dataInizio = strtotime("$checkIn $checkInTime");
$dataFine = strtotime("$checkOut $checkOutTime");
$oreTotali = ($dataFine - $dataInizio) / 3600; // Differenza in ore

// Definizione delle tariffe
$tariffeOrarie = [ "Centro Storico" => 2.00, "Mergellina" => 2.50, "Vomero" => 3.00];

$tariffeGiornaliere = [ "Centro Storico" => 20.00, "Mergellina" => 22.00, "Vomero" => 25.00];


// Se la sosta è di almeno 24 ore, calcoliamo i giorni interi (arrotondando manualmente)
if ($oreTotali >= 24) {
    $giorniInteri = (int)($oreTotali / 24); // Numero intero di giorni
    if ($oreTotali % 24 > 0) { // Se ci sono ore extra, conta un giorno in più
        $giorniInteri += 1;
    }
    $prezzoStimato = $giorniInteri * $tariffeGiornaliere[$sede];
} else {
    $prezzoStimato = $oreTotali * $tariffeOrarie[$sede];
}
?>



<!DOCTYPE html>
<html lang="it">
<head>
    <title>FastPark - Riepilogo Prenotazione</title>
    <meta charset="UTF-8">
    <meta name="generator" content="Visual Studio Code">
    <meta name="author" content="Giovanni Caldarelli">
    <link rel="stylesheet" href="../risorse/css/stylePrenotazione.css">
    <link rel="icon" href="../risorse/immagini/logoP.png" type="image/png">
    <script src="https://js.stripe.com/v3/"></script>
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
                <li><a href="../homePage/homePage.php#contatti">Contatti</a></li>
                <li><a href="../homePage/homePage.php#tariffe">Tariffe</a></li>
                <li><a href="../homePage/homePage.php#come-funziona">Guida Rapida</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="riepilogo-box">
            <h2>Dettagli della Prenotazione</h2>
            <p><strong>Sede:</strong> <?php echo htmlspecialchars($sede); ?></p>
            <p><strong>Check-in:</strong> <?php echo htmlspecialchars($checkIn) . " alle " . htmlspecialchars($checkInTime); ?></p>
            <p><strong>Check-out:</strong> <?php echo htmlspecialchars($checkOut) . " alle " . htmlspecialchars($checkOutTime); ?></p>
            <p><strong>Ore totali:</strong> <?php echo round($oreTotali, 2); ?> ore</p>
            <p><strong>Tariffa oraria:</strong> €<?php echo number_format($tariffeOrarie[$sede], 2); ?> all'ora</p>
            <p><strong>Tariffa giornaliera:</strong> €<?php echo $tariffeGiornaliere[$sede]; ?> al giorno</p>
            <br>
            <p><strong>Prezzo stimato:</strong> €<?php echo $prezzoStimato; ?></p>
        </section>



        <form id="payment-form">
            <div id="card-element">
                <!-- Stripe inserirà il form per la carta qui -->
            </div>
            <div id="card-errors" role="alert"></div>
            <button id="submit">Paga</button>
        </form>

        <script>
            const stripe = Stripe('pk_test_51QrzHZGDPHy7OBYccY6gJnSm0QJ82GwqAjdy2S9r80dMO36TcbG66T5zR2f52Unu6ngJkYIUTObSdV2dX7RJsoE500G83ePYyA'); // Sostituisci con la tua Public Key di Stripe
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            document.getElementById('payment-form').addEventListener('submit', async (event) => {
            event.preventDefault();

            const response = await fetch('processa_pagamento.php', {
                method: 'POST',  headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ importo: <?php echo $prezzoStimato * 100; ?> })
            });

            const result = await response.json();

            if (result.error) {
                document.getElementById('card-errors').textContent = result.error;
            } else {
                const { error, paymentIntent } = await stripe.confirmCardPayment(result.clientSecret, {
                    payment_method: { card: cardElement }
                });

                if (error) {
                    document.getElementById('card-errors').textContent = error.message;
                } else if (paymentIntent.status === 'succeeded') {
                    alert('Pagamento completato con successo!');
                    window.location.href = "successo.php"; 
                } else {
                    alert('Errore durante il pagamento.');
                }
              }
            });
        </script>
    </main>
</body>
</html>
