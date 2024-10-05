<?php



function displayFeedback()
{
    session_start();
    require 'model/Database.php';
    $token = $_GET['token'];
    $RToken = $_GET['RToken'];
    if (Database::checkReservationIsExprired($RToken)) {
        header('location:Expired');
    } else {
        $foods = Database::getFoodsFromReservation($RToken);
        $_SESSION['idClient'] = $token;
        $_SESSION['idRE']=$RToken;
        require 'view/review/feedback.php';
    }
}




function setReview()
{
    require 'model/Database.php';

    $json_string = $_POST["review"];
    $idC = $_SESSION['idClient'];
    $review_data = json_decode($json_string, true);
    try {
        $comment = $review_data['comment'];
        if ($comment != null && $comment != '') {
            Database::insertComment($idC, $comment);
        }

        unset($review_data['comment']);

        foreach ($review_data as $idfood => $rating) {
            if ($rating)
                Database::putRev($idC, $idfood, $rating);
        }
        Database::setToExpired($_SESSION['idRE']);
        echo 'good';
    } catch (Exception $ex) {
        echo 'bad';
    }
}
