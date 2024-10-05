<?php 
    use app\model\Reservation;
    use Stripe\Stripe;
    use Stripe\Customer;
    use Stripe\Charge;
     function displayPAYAction(){
        require 'view/payment/payform.php';
     }


     function CHECKdisplayAction(){
        require 'model/Reservation.php';
        require 'view/payment/checkout.php';
     }


     function handlePayement(){
        require_once('public/vendor/StripeVendor/vendor/autoload.php'); // Include the Stripe PHP library
        require 'model/Reservation.php';

        // Set your secret key: remember to change this to your live secret key in production
        // See your keys hsere: https://dashboard.stripe.com/account/apikeys
        Stripe::setApiKey('sk_test_51OhLfOF95MXSidMRLNjqYhFcbeNhn6XHH75ezUXOuHaLXQaFWIpPWLg14d5PwkZz7mMO2LIXJqT5mowGQArLu3qz00U2OLAJ0h');
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Get POST data
                $token = $_POST['stripeToken'];
                $amount = ($_SESSION['TP']+0.99)*100; // 10.00 USD, adjust this as needed
                $reservation = unserialize($_SESSION['reservation']);
                $idClient = $reservation->getClient()->getId();
                
                // Create a Customer
                $customer = Customer::create([
                    'source' => $token,
                ]);
            
                // Charge the Customer
                $charge = Charge::create([
                    'amount' => $amount,
                    'currency' => 'usd',
                    'description' => 'Reservation charge',
                    'customer' => $customer->id,
                    'metadata' => [
                        'Cus_id' => $idClient,
                    ],
                ]);
    
                // Handle the result
                if ($charge->status == 'succeeded') {
                    // Payment succeeded, redirect to a thank you page            
                    $paymentId = $charge->id;
                    $_SESSION['payID']= $paymentId;
                    $reservation->setStatus(1);         
                } else {
                    $reservation->setStatus(4);         
                }
               
            } catch (Exception $e) {
                // Catch any other exceptions
                $reservation->setStatus(4);         
               
            }
            finally{
                $_SESSION['reservation']=serialize($reservation);
                header('location:storeResrvation');
            }
        } 
    
     }



































     /*
     // Refund code 
     <?php
require_once('vendor/autoload.php'); // Include the Stripe PHP library

\Stripe\Stripe::setApiKey('sk_test_your_secret_key'); // Set your secret key

// Payment Intent ID or Payment Method ID
$paymentIntentId = 'pi_1abcdef123456789'; // Replace with the ID of the original payment intent

// Amount to refund (in smallest currency unit)
$amountToRefund = 500; // $5.00 USD (500 cents)

try {
    // Create a refund
    $refund = \Stripe\Refund::create([
        'payment_intent' => $paymentIntentId,
        'amount' => $amountToRefund,
        'reason' => 'requested_by_customer' // Optional: Reason for refund
    ]);

    // Handle successful refund
    echo "Refund processed successfully: " . $refund->id;
} catch (Exception $e) {
    // Handle refund failure
    echo "Refund failed: " . $e->getMessage();
}
?>
*/

?>


