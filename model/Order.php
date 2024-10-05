<?php 

namespace app\model;



class Order {
    private $idOrder; // int
    private $food; // Food
    private $TotalPrice; // float
    private $Qte; // int



    public function __construct($idOrder, $food, $TotalPrice, $Qte) {
        $this->idOrder = $idOrder;
        $this->food = $food;
        $this->TotalPrice = $TotalPrice;
        $this->Qte = $Qte;
    }
    
    // Getter and Setter methods for idOrder
    public function getIdOrder() {
        return $this->idOrder;
    }

    public function setIdOrder($idOrder) {
        $this->idOrder = $idOrder;
    }

    // Getter and Setter methods for food
    public function getFood() {
        return $this->food;
    }

    public function setFood($food) {
        $this->food = $food;
    }

    // Getter and Setter methods for TotalPrice
    public function getTotalPrice() {
        return $this->TotalPrice;
    }

    public function setTotalPrice($TotalPrice) {
        $this->TotalPrice = $TotalPrice;
    }

    // Getter and Setter methods for Qte
    public function getQte() {
        return $this->Qte;
    }

    public function setQte($Qte) {
        $this->Qte = $Qte;
    }
}



?>