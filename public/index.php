<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Customer;
use App\Posnet;
use App\Card;

// Simulación de uso
$customer = new Customer('12345678', 'Juan', 'Perez');
$card = new Card('Visa', 'Banco de Ejemplo', '12345678', 10000, $customer);

$posnet = new Posnet();
$posnet->registerCard($card);

try {
    $ticket = $posnet->doPayment('12345678', 1000, 3);
    echo json_encode($ticket);
} catch (\Exception $e) {
    echo $e->getMessage();
}
