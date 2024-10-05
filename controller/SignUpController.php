<?php

use app\model\Client;

function displaySignUpPageAction(){
  require 'view/acount/SignUp.php';
}





function checkSignUpAction(){
  require 'model/Client.php';
  $errors=array();
  $agreeChecked = isset($_POST['agree']) && $_POST['agree'] === 'true';
  $client = new Client(null,$_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['password'],null,null);
  $CAPTCHA_URL = "https://www.google.com/recaptcha/api/siteverify";
  $secret_Key = '6LdLQ48pAAAAAF9htVgWzI7Ar9FJCem_t-Uuytni';
  $recaptcha_Response = $_POST['g-recaptcha-response'];
  $recaptcha = file_get_contents($CAPTCHA_URL.'?secret='.$secret_Key.'&response='.$recaptcha_Response);
  $recaptcha=json_decode($recaptcha,true);
  if($recaptcha['success']!=1 && $recaptcha['score']<0.5){
    $errors[]="You are a robot";
 }
  
 if(!isUsernameAcceptable($client->getFirstName())){
    $errors[]="firstname is invalid";
 }
 if(Database::checkEmail($client->getEmail())){
  $errors[]="Gmail you entered is already in use";
 }
 if(!isUsernameAcceptable($client->getLastName())){
  $errors[]="lastname is invalid";
 }
 if(!isGmailAddress($client->getEmail())){
   $errors[]="Gmail is not valid";
 }
 if (strlen($client->getPassword()) < 5) {
  $errors[]="Password must contains more then 5 characters";
}
if(!$agreeChecked){
  $errors[]="please agree on privacy conditions";
}


$jsonData = json_encode($errors);

header('Content-Type: application/json');

// Echo the JSON data
echo $jsonData;
}



function isUsernameAcceptable($username) {
  // Check if the username is not empty
  if (empty($username)) {
      return false;
  }

  // Check if the username contains only alphanumeric characters and underscores
  if (!preg_match('/^[a-zA-Z]+$/', $username)) {
      return false;
  }

 
  // Check if the length of the username is between 3 and 20 characters
  $usernameLength = strlen($username);
  if ($usernameLength < 3 || $usernameLength > 20) {
      return false;
  }

  // Additional criteria can be added based on your specific requirements

  // If all checks pass, the username is acceptable
  return true;
}


function isGmailAddress($email) {
  // Check if the email is not empty
  if (empty($email)) {
      return false;
  }

  // Check if the email follows the general email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return false;
  }

  // Check if the domain is "gmail.com"
  $emailParts = explode('@', $email);
  $domain = end($emailParts);
  if (strtolower($domain) !== 'gmail.com') {
      return false;
  }

  // Additional criteria specific to Gmail can be added

  // If all checks pass, the email is a valid Gmail address
  return true;
} 

?>