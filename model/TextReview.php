<?php 
namespace app\model;

class TextReview {
    private $idTextReview;
    private $description;
    private $client;
    private $status;

    public function __construct($idTextReview, $description, $client, $status) {
        $this->idTextReview = $idTextReview;
        $this->description = $description;
        $this->client = $client;
        $this->status = $status;
    }

    // Getters
    public function getIdTextReview() {
        return $this->idTextReview;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getClient() {
        return $this->client;
    }

    public function getStatus() {
        return $this->status;
    }

    // Setters
    public function setIdTextReview($idTextReview) {
        $this->idTextReview = $idTextReview;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setClient($client) {
        $this->client = $client;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    
}




?>