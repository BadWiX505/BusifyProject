<?php 
namespace app\model;

use Database;

require 'Database.php'; 
require_once 'Person.php';

class Client extends Person{
    private $idClient;
    private $cart;
    public function __construct($id,$firstName, $lastName, $email, $password, $image, $actionDate) {
       parent::__construct($firstName, $lastName, $email, $password, $image, $actionDate);
       $this->idClient = $id;
       $this->cart=new Cart(null,null);
    }
    
   

    public function setId($id){
        $this->idClient= $id;
    }

    public function getId(){
        return $this->idClient;
    }
    
    public function setCart(Cart $cart){
        $this->cart=$cart;
    }

    public function getCart(){
        return $this->cart;
    }


    public function toDatabaseArray() {
        // Convert object properties to an associative array for database insertion
        return [
            'client_F_Name' => $this->getFirstName(),
            'client_L_Name' => $this->getLastName(),
            'Email' => $this->getEmail(),
            'Passwd' => $this->getPassword(),
            'Image' => $this->getImage(),
        ];
    }

   public  function createAcount(){
        $database = Database::getInstance();
       return $database->InsertClient($this);
    }

   public  function login(){
        $database = Database::getInstance();
       return $database->checklogin($this); 
    }


    public function updatePassword(){
        $database = Database::getInstance();
        return $database->updatePasswd($this);
    }


    public static function getDetails($id){
        $database = Database::getInstance();
         return $database->getClientDetails($id);
    }

     public function update(){
        $database = Database::getInstance();
        return $database->UpdateClient($this);
     }

    public function addFoodTocart($food,$qte,$client){
        $database = Database::getInstance();
        $this->cart->setClient($client);
        $this->cart->setFood($food);
        $this->cart->setQte($qte);
        return $database->foodToCart($this->cart);
    }


    public function getCartComponents(){
        $database = Database::getInstance();
        return $database->getCartDetails($this->idClient);
    }
   
    public function deleteFromCart($idFood){
        $database = Database::getInstance();
        return $database->removeFromCart($this->idClient,$idFood);
    }

    public function voidCart(){
        $database = Database::getInstance();
        return $database->voidingcart($this->idClient);
    }
}

  

?>