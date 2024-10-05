<?php   
  require_once('vendor/autoload.php');
  \Stripe\Stripe::setApiKey('sk_test_51OhLfOF95MXSidMRLNjqYhFcbeNhn6XHH75ezUXOuHaLXQaFWIpPWLg14d5PwkZz7mMO2LIXJqT5mowGQArLu3qz00U2OLAJ0h');
  
  $session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'mad',
        'product_data' => [
          'name' => 'metavers',
        ],
        'unit_amount' => 2000,
      ],
      'quantity' => 2,
    ],[
      'price_data' => [
        'currency' => 'mad',
        'product_data' => [
          'name' => 'T_shirt',
        ],
        'unit_amount' => 3000,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'http://localhost:4242/success',
    'cancel_url' => 'http://localhost/PHP/index.php',
  ]);  

?>