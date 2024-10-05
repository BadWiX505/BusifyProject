<?php

use app\model\Client;
   session_start();
   function createClient(){
      require_once 'model/Client.php';
      $hashed_password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
      $client = new Client(null,$_POST['firstname'],$_POST['lastname'],$_POST['email'],$hashed_password,null,null);
      if($client->createAcount()){
      header('location:suc');
      }
      else{
      header('location:err');
      }
   }


   function updatePassword(){
      require_once 'model/Client.php';
      $password = $_POST['password'];
      $emai=$_POST['email'];
      $hashed_Password = password_hash($password,PASSWORD_DEFAULT);
      $client = new Client(null,null,null,$emai,$hashed_Password,null,null);
      
       return $client->updatePassword();
        
    }
    

?>