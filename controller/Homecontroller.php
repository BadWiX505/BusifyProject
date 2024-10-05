<?php 

function indexAction(){
    session_start();
    // $_SESSION['idClient']=23;
     $newFoods=getnewFoods();
     $chefs = getChefs();
     $statistics = getStatistics();
     require 'view/Home.php';
}

function getnewFoods(){
    require 'model/Database.php';
    return Database::getNewFood();
}

function getChefs(){
    return Database::getAllChefs('only');
}

function getReview(){
    require 'model/Client.php';
    $page = $_POST['page'];
   $textReview =  Database::getreview($page);

   if ($textReview) {
    // Send the review data back as JSON
    header('Content-Type: application/json');
    $image = base64_encode($textReview->getClient()->getImage());
    $jsonString = json_encode([
        'description' => $textReview->getDescription(),
        'firstName' => $textReview->getClient()->getFirstName(),
        'lastName' => $textReview->getClient()->getLastName(),
       'image' => $image,
        'error' => 'none',
    ]);

    echo $jsonString;
   } else {
    // Handle case where no reviews are found
    echo json_encode(array('error' => 'No reviews found'));
   }

}


function getStatistics(){
    return Database::getAllStatistics();
   }
?>