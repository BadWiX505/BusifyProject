<?php

use app\model\Client;
use app\model\Food;


function displayMenuPageAction(){
    $promofoodList = getPromoFoodList();
    require 'view/Menu.php';
}


function getPromoFoodList(){
    require 'model/Database.php';

  return Database::FoodList('promo',null);
}


function getFoodList($para){
  require 'model/Database.php';
return Database::FoodList($para,null);
}



function filterFoodAction(){
  $para = isset($_GET['param']) ? $_GET['param'] : '';
  $quuery = "and (subcategorie.name = '$para' or
  mealTime.name = '$para')";
  $foodList = getFoodList($quuery);
  $html = generateFoodHTML($foodList);
  echo $html;
}

function addToCartAction(){
  require 'model/Client.php';
  $data = array();
  $status = 'failed';
  $statusMsg = '';
  if(isset($_SESSION['idClient'])){
    $idFood = $_GET['idFood'];
    $qte = $_GET['Qte'];
    if(  (checkQte($_SESSION['idClient'])+$qte) <= 15 ){
      $client= new Client($_SESSION['idClient'],null,null,null,null,null,null);
      $food = new Food($idFood,null,null,null,null,null,null,null,null,null,null,null,null);
          if($client->addFoodTocart($food,$qte,$client)){
            $status='success';
            $statusMsg='Added successfully';
          }
    }
    else{
      $statusMsg = "You ritch the max Qte please lower Qte MAX is 15";
    }
  }
  else{
    $statusMsg = 'You are not logged';
  }

  $data = array(
    'status' => $status,
    'msg' => $statusMsg
  );

  $jsonString = json_encode($data);

  header('Content-Type: application/json');

  echo $jsonString;
}






function checkQte($idClient){
  return Database::getCartQte($idClient);
}



function generateFoodHTML($allFood) {
  $html = '';
  if($allFood!=null){
  foreach ($allFood as $item) {
      $html .= '<div class="dishescontainer" data-food-id="'.$item->getIdFood().'">';
      $html .= '<div class="foodimgcontainer">';
      $html .= '<img src="data:image;base64,' . base64_encode($item->getImage()) . '" class="foodimage">';
      $html .= '</div>';
      $html .= '<h2 class="dishesname">' . $item->getFoodName() . '</h2>';
      $html .= '<p class="foodcategorie">' . $item->getCategorie() . '</p>';
      $html .= '<div class="starscontainer">';
      for ($i = 1; $i <= $item->getReviews(); $i++) {
          $html .= '<i class="fa-solid fa-star"></i>';
      }
      $html .= '</div>';
      $html .= '<p class="fooddescription">' . $item->getFoodDescription() . '</p>';
      $html .= '<div class="priceandaddbtn">';
      $style = '';
      $newPrice = '';
      if ($item->getIsItPromo()) {
          $style = 'text-decoration: line-through;';
          $newPrice = $item->getPromoPrice() . '$';
      }
      $html .= '<div class="price" style="' . $style . '">' . $item->getPrice() . '$</div>';
      $html .= '<p>' . $newPrice . '</p>';
      $html .= '<button class="addbtn" ><i class="fa-solid fa-plus"></i></button>';
      $html .= '</div>';
      $html .= '<div class="bigcategorie" style="display: none;">Lunch</div>';
      $html .= '<div class="subcategorie" style="display: none;">Main course</div>';
      $html .= '</div> ';
     
  }
 
}
  return $html;
}
?>