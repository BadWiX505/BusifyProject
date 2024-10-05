<?php 
namespace app\model;

class Chef {
    private $idChef;
    private $chefFullName;
    private $level;
    private $fb;
    private $in;
    private $ig;
    private $image;

    public function __construct($idChef, $chefFullName, $level, $fb, $in, $ig, $image) {
        $this->idChef = $idChef;
        $this->chefFullName = $chefFullName;
        $this->level = $level;
        $this->fb = $fb;
        $this->in = $in;
        $this->ig = $ig;
        $this->image = $image;
    }

    // Getters
    public function getIdChef() {
        return $this->idChef;
    }

    public function getChefFullName() {
        return $this->chefFullName;
    }

    public function getLevel() {
        return $this->level;
    }

    public function getFb() {
        return $this->fb;
    }

    public function getIn() {
        return $this->in;
    }

    public function getIg() {
        return $this->ig;
    }

    public function getImage() {
        return $this->image;
    }

    // Setters
    public function setIdChef($idChef) {
        $this->idChef = $idChef;
    }

    public function setChefFullName($chefFullName) {
        $this->chefFullName = $chefFullName;
    }

    public function setLevel($level) {
        $this->level = $level;
    }

    public function setFb($fb) {
        $this->fb = $fb;
    }

    public function setIn($in) {
        $this->in = $in;
    }

    public function setIg($ig) {
        $this->ig = $ig;
    }

    public function setImage($image) {
        $this->image = $image;
    }
}


?>