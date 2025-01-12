<?php
namespace App;

class Posnet
{
    private $cards = [];

    public function registerCard(Card $card)
    {
        $this->cards[$card->getNumber()] = $card; // Usar el getter aquí
    }
    

    public function doPayment($cardNumber, $amount, $installments)
    {
        if (!isset($this->cards[$cardNumber])) {
            throw new \Exception('Card not registered');
        }

        $card = $this->cards[$cardNumber];
        $totalAmount = $this->calculateTotalAmount($amount, $installments);

        $card->reduceLimit($totalAmount);

        return $this->generateTicket($card, $totalAmount, $installments);
    }

    private function calculateTotalAmount($amount, $installments)
    {
        if ($installments < 1 || $installments > 6) {
            throw new \InvalidArgumentException('Invalid number of installments');
        }

        $extraPercentage = ($installments > 1) ? 0.03 * ($installments - 1) : 0;
        return $amount * (1 + $extraPercentage);
    }

    private function generateTicket(Card $card, $totalAmount, $installments)
    {
        $customer = $card->getCustomer();
        $installmentAmount = $totalAmount / $installments;

        return [
            'customer' => $customer->getFullName(),
            'total_amount' => $totalAmount,
            'installment_amount' => $installmentAmount
        ];
    }
}
