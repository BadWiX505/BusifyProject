<?php  


     function displayErrAction(){
        require 'view/Err404/ERR.php';
     }

     function displaySUCAction(){
        require_once 'view/Err404/SUC.php';
     }

     function displayExpired(){
      require 'view/Err404/Epired.php';
     }
?>