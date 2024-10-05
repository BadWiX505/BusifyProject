<?php

namespace app\model;

use Database;

require 'model/Promo.php';

class Food {
    private $idFood;
    private $foodName;
    private $price;
    private $foodDescription;
    private $reviews;
    private $isItPromo;
    private $isItAvailable;
    private $actionDate;
    private $Categorie;
    private $MealTime;
    private $promo;
    private $SubCategorie;
    private $promoPrice;
    private $image;

    // Constructor
    public function __construct($idFood, $foodName, $price, $foodDescription, $reviews, $isItPromo, $isItAvailable, $actionDate, $Categorie, $MealTime, $SubCategorie,$promo,$image) {
        $this->idFood = $idFood;
        $this->foodName = $foodName;
        $this->price = $price;
        $this->foodDescription = $foodDescription;
        $this->reviews = $reviews;
        $this->isItPromo = $isItPromo;
        $this->isItAvailable = $isItAvailable;
        $this->actionDate = $actionDate;
        $this->Categorie = $Categorie;
        $this->MealTime = $MealTime;
        $this->SubCategorie = $SubCategorie;
        $this->promo = $promo;
        $this->promoPrice = $this->calcPromoPrice();
        $this->image=$image;
        
    }


    
    

    // Setters
    public function setIdFood($idFood) {
        $this->idFood = $idFood;
    }

    public function setFoodName($foodName) {
        $this->foodName = $foodName;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setFoodDescription($foodDescription) {
        $this->foodDescription = $foodDescription;
    }

    public function setReviews($reviews) {
        $this->reviews = $reviews;
    }

    public function setIsItPromo($isItPromo) {
        $this->isItPromo = $isItPromo;
    }

    public function setIsItAvailable($isItAvailable) {
        $this->isItAvailable = $isItAvailable;
    }

    public function setActionDate($actionDate) {
        $this->actionDate = $actionDate;
    }

    public function setCategorie($Categorie) {
        $this->Categorie = $Categorie;
    }

    public function setMealTime($MealTime) {
        $this->MealTime = $MealTime;
    }

    public function setSubCategorie($SubCategorie) {
        $this->SubCategorie = $SubCategorie;
    }

    public function setPromoPrice($promoPrice) {
        $this->promoPrice = $promoPrice;
    }
    public function setPromo($promo){
        $this->promo=$promo;
    }
    public function setImage($image){
        $this->image=$image;
    }

    // Getters
    public function getIdFood() {
        return $this->idFood;
    }

    public function getFoodName() {
        return $this->foodName;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getFoodDescription() {
        return $this->foodDescription;
    }

    public function getReviews() {
        return $this->reviews;
    }

    public function getIsItPromo() {
        return $this->isItPromo;
    }

    public function getIsItAvailable() {
        return $this->isItAvailable;
    }

    public function getActionDate() {
        return $this->actionDate;
    }

    public function getCategorie() {
        return $this->Categorie;
    }

    public function getMealTime() {
        return $this->MealTime;
    }

    public function getSubCategorie() {
        return $this->SubCategorie;
    }

   
    public function getPromo() {
        return $this->promo;
    }

    public function getPromoPrice() {
        return $this->promoPrice;
    }
    public function getImage(){
        return $this->image;
    }




   public function calcPromoPrice(){
    if($this->isItPromo){
      return $this->price - ($this->price * $this->promo->getDiscount() / 100);
    }
    else{
        return null;
    }
   }

}

?>
