<?php
require 'config.php'; // Importa la configurazione di Stripe

// Imposta l'intestazione per JSON
header('Content-Type: application/json');

// Recupera l'importo dal POST (assicurati che sia stato inviato)
if (!isset($_POST["importo"])) {
    echo json_encode(["error" => "Importo non specificato"]);
    exit();
}

$importo = (int) $_POST["importo"]; // Importo in centesimi (es. 1000 = €10.00)

try {
    // Crea un Payment Intent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $importo,
        'currency' => 'eur',
        'payment_method_types' => ['card'],
        'description' => 'Pagamento FastPark'
    ]);

    // Restituisce la client_secret per completare il pagamento lato client
    echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
