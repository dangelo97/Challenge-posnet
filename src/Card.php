<?php
namespace App;

class Card
{
    private $type;
    private $bank;
    private $number;
    private $limit;
    private $customer;

    public function __construct($type, $bank, $number, $limit, Customer $customer)
    {
        if (!in_array($type, ['Visa', 'AMEX'])) {
            throw new \InvalidArgumentException('Invalid card type');
        }

        if (strlen($number) != 8) {
            throw new \InvalidArgumentException('Card number must be 8 digits');
        }

        $this->type = $type;
        $this->bank = $bank;
        $this->number = $number;
        $this->limit = $limit;
        $this->customer = $customer;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function reduceLimit($amount)
    {
        if ($this->limit < $amount) {
            throw new \Exception('Insufficient limit');
        }

        $this->limit -= $amount;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}
