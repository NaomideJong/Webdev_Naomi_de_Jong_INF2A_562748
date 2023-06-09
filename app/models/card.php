<?php

namespace models;

class Card
{
    public $amount;
    public $name;
    public $price;

    public function __construct($amount, $name, $price)
    {
        $this->amount = $amount;
        $this->name = $name;
        $this->price = $price;
    }
    public function getPrice() : ?float
    {
        return $this->price;
    }
    public function getAmount() : int
    {
        return $this->amount;
    }
    public function getName() : string
    {
        return $this->name;
    }

}