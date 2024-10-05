<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="public/css/Fonts.css">
        <link rel="stylesheet" type="text/css" href="public/css/HomeStyling.css">
        <link rel="stylesheet" type="text/css" href="public/css/colors.css">
        <link rel="stylesheet" type="text/css" href="public/css/pageloderstyling.css">
        <link rel="stylesheet" type="text/css" href="public/css/foodpanelstyling.css">
        <link rel="stylesheet" type="text/css" href="public/css/footerstyling.css">
    <title><?= $title ?></title>
   
</head>
<body>
    

<!--  display config btns -->
<button class="toTop"><i class="fa-solid fa-up-long"></i></button>

<button class="darkmodebtn"><i class="fa-solid fa-moon"></i></button>
<!--   End  ------------------- -->

<!-- Confirmation Popup -->
<div class="confirmation-modal" id="confirmationModal">
        <h1>Confirmation</h1>
        <p>Are you sure?</p>
        <button  id="confirmbtn">Confirm</button>
        <button  id="cancelbtn">Cancel</button>
    </div>
    <!-- END CONF POPUP --------->

    <!-- Loader-->
  <div class="loadercontainer">
        <div class="loader">
            <span class="hour"></span>
            <span class="min"></span>
            <span class="circel"></span>
        </div>
    </div> 
    <div id="addingresult">test test</div>
    
    <section class="<?php echo $classes?>">
     <?php  include 'view/logOptions.php'?>

     <?php include 'view/cartview.php'?>

    <!-- End loader-->
    
