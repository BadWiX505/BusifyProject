<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="public/css/Fonts.css">
    <link rel="stylesheet" type="text/css" href="public/css/checkoutstyling.css">
    <title>Checkout</title>
</head>
<body>
    <?php $reservation = unserialize($_SESSION['reservation']);
      $orders = $reservation->getOrder();
      $totalPrice=0;
    ?>
    <div class="master-container">
        <div class="card cart">
          <label class="title"  style="font-family: niceFont;">Your cart</label>
          <div class="products">
            <?php foreach($orders as $orderItem) :?>
            <div class="product">
             <img src="<?php echo "data:image;base64,".base64_encode($orderItem->getFood()->getImage());?>" alt="food image">
              <div>
                <span style="font-family: foodname;"><?php echo $orderItem->getFood()->getFoodName();?></span>
                
                <p style="color: #fd9900;"> 
                    <?php 
                      for ($i = 1; $i <= $orderItem->getFood()->getReviews(); $i++) { ?>
                        <i class="fa-solid fa-star"></i>
                        <?php
                        }
                     ?>
                 </p>
                <p style="font-family: littletext;"><?php echo $orderItem->getFood()->getCategorie(); ?></p>
              </div>
              <div class="quantity">
              
                <label><?php echo $orderItem->getQte()?></label>
               
              </div>
              <label class="price small"><?php echo $orderItem->getTotalPrice() ?>$</label>
            </div>
            <?php  $totalPrice+= $orderItem->getTotalPrice();?>
            <?php endforeach;?>
          </div>


        </div>
      
      
        <div class="card checkout">
          <label class="title" style="font-family: niceFont;">Checkout</label>
          <div class="details" style="font-family: littletext;">
            <span>Your cart subtotal:</span>
            <span><?=$totalPrice?>$</span>
            <?php $_SESSION['TP']=$totalPrice;?>
            <span>Tax fees:</span>
            <span>0.99$</span>
          </div>
          <div class="checkout--footer">
            <label class="price"><sup>$</sup><?=$totalPrice+0.99?></label>
            <a href="PAY"><button class="checkout-btn" style="cursor: pointer;">Checkout</button></a>
          </div>
        </div>
      </div>
</body>
</html>