<?php
namespace app\model;

class Promo {
    private $idPromo;
    private $discount;

    public function __construct($idPromo, $discount) {
        $this->idPromo = $idPromo;
        $this->discount = $discount;
    }

    // Getters
    public function getIdPromo() {
        return $this->idPromo;
    }

    public function getDiscount() {
        return $this->discount;
    }

    // Setters
    public function setIdPromo($idPromo) {
        $this->idPromo = $idPromo;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
    }
}

?>
