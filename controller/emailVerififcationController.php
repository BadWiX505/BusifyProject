
<?php 
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
  session_start();

   function DisplayEVAction(){
       require 'view/acount/emailverificationview.php';
   }



   function sendConfiEmail(){
       $destinaetionEmail = $_POST['email'];
       $clientName = $_POST['firstname'];
       $codeV = generateRandomDigits(4);
       sendMail($destinaetionEmail,generatEmailMsg($clientName,$codeV));
       $_SESSION['Vcode']=$codeV;
   }


   function checkVerificationCode() {
    $response = array();

    if (isset($_SESSION['Vcode'])) {
        if ($_POST['code'] === $_SESSION['Vcode']) {
            $response['status'] = 'nice';
        } else {
            $response['status'] = 'bad';
        }
    } else {
        $response['status'] = 'bad';
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}



    function sendMail($destination,$msg){
    require 'public/vendor/PHPMailer/src/Exception.php';
    require 'public/vendor/PHPMailer/src/SMTP.php';
    require 'public/vendor/PHPMailer/src/PHPMailer.php';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='mebadwi@gmail.com';
    $mail->Password='psnxhlhkbtckpinz';
    $mail->SMTPSecure='ssl';
    $mail->Port=465;
    $mail->setFrom('mebadwi@gmail.com');
    $mail->addAddress($destination);
    $mail->isHTML(true);
    $mail->Subject="Confirmation code";
    $mail->Body=$msg;
  try{
    $mail->send();
    }
    catch(Exception $ex){
      echo $ex;
     echo "email has not been sent successfully try again";
    }
   }


   // generate email msg 
   function generatEmailMsg($clientName,$codeV){
   return  '
   <div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
   <div style="margin:50px auto;width:70%;padding:20px 0">
     <div style="border-bottom:1px solid #eee">
       <a href="" style="font-size:1.4em;color: #fd9900;text-decoration:none;font-weight:600">Email Confirmation</a>
     </div>
     <p style="font-size:1.1em">Hi, Mr '.$clientName.' </p>
     <p>Thank you for choosing Our restaurant. Use the following OTP to complete your Sign Up procedures. OTP is valid for 2 minutes</p>
     <h2 style="background: #fd9900;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">'.$codeV.'</h2>
     <p style="font-size:0.9em;">Regards,<br />Restaurant</p>
     <hr style="border:none;border-top:1px solid #eee" />
     <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
     </div>
   </div>
   
 </div>    ';
   }

// generate confirmaation code 4 digits
   function generateRandomDigits($length = 4) {
    // Ensure the length is at least 1
    $length = max(1, $length);
 
    // Generate random digits
    $randomDigits = '';
    for ($i = 0; $i < $length; $i++) {
        $randomDigits .= rand(0, 9);
    }
 
    return $randomDigits;
 }
?>