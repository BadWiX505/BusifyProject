<?php 

 function displayAboutPage(){
    $allchefs = displayChefs();
    require 'view/AboutUs.php';
 }

function displayChefs(){
    require 'model/Database.php';
    return Database::getAllChefs('all');
}

?>