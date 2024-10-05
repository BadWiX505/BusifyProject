<?php
namespace app\model;

use app\model\Client;

class Cart {

    private $food; 
    private $Qte; 
    private $client; 

    // Constructor to initialize the attributes
    public function __construct($food, $Qte) {
        $this->food = $food;
        $this->Qte = $Qte;
    }

    // Method to get the food item
    public function getFood() {
        return $this->food;
    }

    // Method to set the food item
    public function setFood($food) {
        $this->food = $food;
    }

    // Method to get the quantity
    public function getQte() {
        return $this->Qte;
    }

    // Method to set the quantity
    public function setQte($Qte) {
        $this->Qte = $Qte;
    }

    public function setClient($client){
        $this->client=$client;
    }

    public function getClient() {
        return $this->client;
    }
}

?>
