<?php

use app\model\Client;
use app\model\Reservation;
use app\model\Order;


function displayReservationAction()
{
    require 'view/Reservation.php';
}

function ValidateRI()
{
    require 'model/Client.php';
    if (isset($_SESSION['idClient'])) {
        $phone = $_GET['phone'];
        $persons = $_GET['persons'];
        $date = $_GET['date'];
        $time = $_GET['Time'];
        if (isValidPhoneNumberFormat($phone)) {
            if ($date == '' || $time == '' || $persons == '') {
                echo 'complete fields !';
            } else {
                $client = new Client($_SESSION['idClient'], null, null, null, null, null, null);
                if ($client->getCartComponents() == null) {
                    echo "Your cart is empty";
                } else {
                    echo "good";
                }
            }
        } else {
            echo "phone number is invalid";
        }
    } else {
        echo "log";
    }
}



function prepReservation(){
    if($_SERVER['REQUEST_METHOD']==='POST'){
        require 'model/Reservation.php';
        $phone = $_POST['tel'];
        $persons = $_POST['persons'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $client = new Client($_SESSION['idClient'],null,null,null,null,null,null);
        $orders;
        $carts = $client->getCartComponents();
        foreach($carts as $cartItem){
            $foodPrice = $cartItem->getFood()->getIsItPromo() ? $cartItem->getFood()->getPromoPrice() : $cartItem->getFood()->getPrice();
            $totalPrice = $foodPrice*$cartItem->getQte();
           $orders[]= new Order(null,$cartItem->getFood(),$totalPrice,$cartItem->getQte());
        }

        $reservation = new Reservation(null,$date,convertTimeTo24HourFormat($time),getNumberOfPersons($persons),$phone,null,$orders,$client,null);
        $_SESSION['reservation']=serialize($reservation);
        header('location:CHECK');
    }
}


function storeReserrvationDetails(){
    require 'model/Reservation.php';
    if(isset($_SESSION['reservation'])){
    $reservation = unserialize($_SESSION['reservation']);
      if($reservation->insertMyDetails()){
      if($reservation->getStatus()===1){
        header('location:ThankYou');
    }
    else{
      header('location:failedPAY');
    }
      }
    }

}

// get Number of persons 
function getNumberOfPersons($input) {
    // Use regular expression to extract the numerical value
    preg_match('/\d+/', $input, $matches);
    
    // If a numerical value is found, return it, otherwise return 0
    return isset($matches[0]) ? intval($matches[0]) : 0;
}



// get Time for database from a Time input 
function convertTimeTo24HourFormat($timeString) {
    // Splitting the time string into hours, minutes, and AM/PM
    $parts = explode(' ', $timeString);
    $timeParts = explode(':', $parts[0]);
    $hours = intval($timeParts[0]);
    $minutes = intval($timeParts[1]);
    $ampm = strtolower($parts[1]);

    // Adjusting hours for PM
    if ($ampm === 'pm' && $hours < 12) {
        $hours += 12;
    }
    // Adjusting hours for AM
    if ($ampm === 'am' && $hours === 12) {
        $hours = 0;
    }

    // Formatting the time in 24-hour format
    $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
    $minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);

    return "$hours:$minutes:00";
}





function isValidPhoneNumberFormat($phoneNumber)
{
    // Check if the phone number is at least 10 characters long and contains only numeric digits
    if (strlen($phoneNumber) >= 10 && ctype_digit($phoneNumber)) {
        return true; // Phone number format is valid
    } else {
        return false; // Phone number format is not valid
    }
}




function getTimeSelectors()
{
    require 'model/Database.php';
    $selDate = $_GET['date'];
    $notavailableTimes = Database::selectNotAvailableTimes($selDate);
    $allTimes = getAllTimes();
    $availableTimes = array_diff($allTimes, $notavailableTimes);

    // Set the content type header to JSON
    header('Content-Type: application/json');

    $availableTimesJson = json_encode($availableTimes);

    // Send the JSON data to JavaScript
    echo $availableTimesJson;
}




function getAllTimes()
{
    $timeArray = array();

    // Set the start time
    $startTime = strtotime('7:00:00');

    // Set the end time
    $endTime = strtotime('21:00:00');

    // Increment the time by 2 hours until it reaches the end time
    while ($startTime <= $endTime) {
        // Format the time and add it to the array
        $timeArray[] = date('H:i:s', $startTime);

        $startTime += 2 * 60 * 60; // 2 hours in seconds
    }
    return $timeArray;
}
