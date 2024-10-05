<?php
use app\model\Client;


function displayCart()
{
     $cartList = getCart();
     $html='';
    if($cartList!=null){
        $html= generateCartHtml($cartList);
    }
    echo $html;
}

function delcart(){
  if(isset($_SESSION['idClient'])){
    require 'model/Client.php';
        $idFood = $_GET['idF'];
        $client = new Client($_SESSION['idClient'],null,null,null,null,null,null);
       if($client->deleteFromCart($idFood)){
          echo 'success';
       }
       else echo 'failed';
  }
}

function getCart(){
    require 'model/Client.php';
    if(isset($_SESSION['idClient'])){
      $client = new Client($_SESSION['idClient'],null,null,null,null,null,null);
      return $client->getCartComponents();
    }
    else{
      return null;
    }
    
  }


  function getTotalQtee(){
    if(isset($_SESSION['idClient'])){
        require 'model/Database.php';
       echo Database::getCartQte($_SESSION['idClient']);
    }
    else{
        echo 0;
    }
  }
    


function generateCartHtml($cartList)
{
    $html = '';
   $totalPrice=0;
    foreach($cartList as $item){
    $html .= '<div class="food" data-cartfood-id="'.$item->getFood()->getIdFood().'">';
    $html .= '<button class="confirmation-btn removefrompanel"><i class="fa-solid fa-xmark"></i></button>';
    $html .= '<div class="panelimgcontainer">';
    $html .= '<img src="data:image;base64,' . base64_encode($item->getFood()->getImage()) . '">';
    $html .= '</div>';
    $html .= '<div class="paneltextcontent">';
    $html .= '<p class="panelfoodname">'.$item->getFood()->getFoodName().'</p>';
    $html .= '<p class="panelfoodstars">';
     for ($i = 1; $i <= $item->getFood()->getReviews(); $i++) {
        $html .= '<i class="fa-solid fa-star"></i>';
      }
    $html .= '</p>';        
    $html .= '<div>';
    $price= $item->getFood()->getIsItPromo() ? $item->getFood()->getPromoPrice() : $item->getFood()->getPrice();
    $html .= '<p class="panelfoodprice">'.$price.'$</p>';
    $html .= '<p>Qte : <span id="panelfoodqte">'.$item->getQte().'</span></p>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $totalPrice+=$price*$item->getQte();
    }
    $html .= '<p style="display:none !important;" class="tot">'.$totalPrice.'</p>';
    return $html;
}
