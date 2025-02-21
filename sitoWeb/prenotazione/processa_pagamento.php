<?php
require 'config.php';

header('Content-Type: application/json');

if (!isset($_POST["importo"])) {
    echo json_encode(["error" => "Importo non specificato"]);
    exit();
}
$importo = (int) $_POST["importo"]; 

try {
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $importo,
        'currency' => 'eur',
        'payment_method_types' => ['card'],
        'description' => 'Pagamento FastPark'
    ]);

    echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
