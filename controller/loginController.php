<?php 

use app\model\Client;

  function displayLoginAction(){
    require 'view/acount/logIn.php';
  }


  function checkSignUpAction(){
    require 'model/Client.php';
    $errors=array();
    $remember = isset($_POST['remember']) && $_POST['remember'] === 'true';
    $client = new Client(null,null,null,$_POST['email'],$_POST['password'],null,null);
    $CAPTCHA_URL = "https://www.google.com/recaptcha/api/siteverify";
    $secret_Key = '6LdLQ48pAAAAAF9htVgWzI7Ar9FJCem_t-Uuytni';
    $recaptcha_Response = $_POST['g-recaptcha-response'];
    $recaptcha = file_get_contents($CAPTCHA_URL.'?secret='.$secret_Key.'&response='.$recaptcha_Response);
    $recaptcha=json_decode($recaptcha,true);
    if($recaptcha['success']!=1 && $recaptcha['score']<0.5){
      $errors[]="You are a robot";
   }
    
    if(!$client->login()){
        $errors[]="Gmail or Password is incorrect";
    }
    else{
        if($remember){
            setcookie("id",Database::getIdfromemail($client->getEmail()), time() + 3600, "/", null, true, true);
        }
    }
   
  
  $jsonData = json_encode($errors);
  
  header('Content-Type: application/json');
  
  // Echo the JSON data
  echo $jsonData;
  }


 
?>