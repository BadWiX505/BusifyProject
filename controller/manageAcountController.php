<?php
  use app\model\Client;
  use app\model\Reservation;


   function dipslayManage($client,$reservations){
    require 'view/acount/manageAcount.php';
   }


   function getDetails(){
     $idClient = $_SESSION['idClient'];
     $client=null;
     return $client=Client::getDetails($idClient);
   }

   function getClientReservations(){
    return getRseervationsDetails();
   }

   

    // check infos and update 

   function checkAcountInfosAction(){
    require 'model/Client.php';
    $firstname = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $pass = $_POST['curPass'];
    $newPass = $_POST['newPass'];
    $confNewPass = $_POST['confNewPass'];
    $idClient = $_SESSION['idClient'];
    $image=null;

    if(isset($_FILES["image"])){
      if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
        // Read the uploaded file
        $image = file_get_contents($_FILES["image"]["tmp_name"]);
      }
    }

    if($firstname=='' || $lastName=='' || !(($pass== $newPass && $newPass== $confNewPass && $confNewPass=='') || ($pass!=''  && $newPass!=''  && $confNewPass!=''))){
      echo 'Complete fields please';
    }
    else{
       if($newPass!=$confNewPass)  echo 'Enter a valid confirmation password please';
       else{
        if(!isUsernameAcceptable($firstname) || !isUsernameAcceptable($lastName) || ((strlen($pass)<5 && $pass!='')|| (strlen($newPass)<5 && $newPass!='') || (strlen($confNewPass)<5 && $confNewPass!=''))){
          echo 'Usernames or passwords are invalid';
        }
        else{
          if(password_verify($pass,Database::getclientPass($idClient)) || $pass==''){
            $hashedPass='';
            if($newPass!=''){
            $hashedPass = password_hash($newPass,PASSWORD_DEFAULT);
            }
              $client = new Client($idClient,$firstname,$lastName,null,$hashedPass,$image,null);
              if($client->update()) echo 'good';
              else echo 'Something went wrong';
          }
          else{
            echo 'current Password in incorrect';
          }
        }
       }
    }

   }



   function getRseervationsDetails(){
    require 'model/Reservation.php';
    return Database::getReservationDetails($_SESSION['idClient']);
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





  
?>