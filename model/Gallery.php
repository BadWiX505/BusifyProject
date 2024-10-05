<?php 

namespace app\model;

class Gallery {
    private $idImage;
    private $image;
    private $description;

    // Constructor
    public function __construct($idImage, $image, $description) {
        $this->idImage = $idImage;
        $this->image = $image;
        $this->description = $description;
    }

    // Getters
    public function getIdImage() {
        return $this->idImage;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    // Setters
    public function setIdImage($idImage) {
        $this->idImage = $idImage;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
}

?>