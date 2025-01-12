<?php
namespace App;

class Customer
{
    private $dni;
    private $firstName;
    private $lastName;

    public function __construct($dni, $firstName, $lastName)
    {
        $this->dni = $dni;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public function getFullName()
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
