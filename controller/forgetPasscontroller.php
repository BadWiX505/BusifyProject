<?php 

function Displayforgetpassword(){
    require 'view/acount/forgetPass.php';
}

function displayGConfirmationAction(){
 require 'view/acount/forgetconirmation.php';
}


function displayNewPassAction(){
  require 'view/acount/newPass.php';
}


// check Gmail validity before submitting

function  checkGmailAction(){
    require 'model/Database.php';
    $errors=array();
    $email = $_POST['email'];
    $CAPTCHA_URL = "https://www.google.com/recaptcha/api/siteverify";
    $secret_Key = '6LdLQ48pAAAAAF9htVgWzI7Ar9FJCem_t-Uuytni';
    $recaptcha_Response = $_POST['g-recaptcha-response'];
    $recaptcha = file_get_contents($CAPTCHA_URL.'?secret='.$secret_Key.'&response='.$recaptcha_Response);
    $recaptcha=json_decode($recaptcha,true);
    if($recaptcha['success']!=1 && $recaptcha['score']<0.5){
      $errors[]="You are a robot";
   }
   if(!Database::checkEmail($email)){
    $errors[]="gmail is invalid or doesn't exists";
   }
   $jsonData = json_encode($errors);
  
  header('Content-Type: application/json');
  
  echo $jsonData;
     
}




// send verification code
function sendGVC(){
   require 'controller/emailVerififcationController.php';
   $destination = $_POST['email'];
   $genCode = generateRandomCode(8);
   $msg = emailbody($genCode);
   sendMail($destination,$msg);
   $_SESSION['GVCODE'] = $genCode;
}


// function to generate GVC 
function generateRandomCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    $maxIndex = strlen($characters) - 1;
    
    for ($i = 0; $i < $length; $i++) {
        $randomIndex = mt_rand(0, $maxIndex);
        $code .= $characters[$randomIndex];
    }
    
    return $code;
}






 function checkPassValidity(){
  $pass = $_POST['password'];
  if(strlen($pass)<5){
    echo  'bad';
  }
  else{
    echo 'good';
  }
 }


// check the validity of code
function checkgmailcodeAction(){
    $code = $_POST['code'];
   if(isset($_SESSION['GVCODE'])){
     if($_SESSION['GVCODE']===$code){
        echo "good";
     }
     else{
        echo 'bad';
     }
   }
   else echo 'bad';
}



function emailbody($code){
    return '<!DOCTYPE html>
    <html>
    
    <head>
      <meta charset="utf-8" />
      <title></title>
      <style>
        * {
          box-sizing: border-box;
        }
          body{
            display:flex;
            justify-content: center;
          }
      </style>
    </head>
    
    <body style="background-color: #f4f4f4; font-family: Roboto, arial, sans-serif">
      <div style="background-color: #fd9900; height: 140px;">
      </div>
      <div class="box" style="max-width: 550px; background-color: white; margin: -80px auto 0 auto; padding: 20px 60px 80px 60px;">
        <div style="  font-size: 30px; font-weight: 300; margin-top: 20px; text-align: center;"> Emai Confirmation !</div>
        <br />
        <p>Hi, here is your verification code please past it in the code box to continue.</p>
        <div class=" box-sizing: border-box; width: 100%;">
          <br />
          <br />
          <div style="font-size: 18px; text-align: center">
          '.$code.'
          </div>
    
        </div>
      </div>
    </body>
    
    </html>';
}
?>