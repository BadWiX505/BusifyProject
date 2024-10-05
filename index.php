<?php
if (empty($_GET['action'])) {
    homeRouter();
} else {

    $action = $_GET['action'];
    switch ($action) {
        case "Home":
            homeRouter();
            break;
        case "Menu":
            MenuRouter();
            break;
        case "signUp":
            SignUpRouter();
            break;
        case "checkSignUp":
            checkSignUp();
            break;
        case "verifyEmail":
            verifyEmailRouter();
            break;
        case "sendCE":
            sendConfirmationEmail();
            break;
        case "checkCC":
            checkConfirmationCode();
            break;
        case "storeclient":
            CreateClientRouter();
            break;
        case "err":
            displayERR();
            break;
        case "suc":
            displaySUC();
            break;
        case "logout":
            logout();
            break;
        case "login":
            loginView();
            break;
        case "checkLogin":
            checkLogin();
            break;
        case "forgetPass":
            forgetpassword();
            break;
        case "cGmail":
            checkGmail();
            break;
        case "Gverification":
            verifyG();
            break;
        case "sendGVcode":
            sendGVcode();
            break;
        case "newPassword":
            newPasword();
            break;
        case "passvalidity":
            passValidity();
            break;
        case "updatePass":
            updatePass();
            break;
        case "manageDisplay":
            manageDispay();
            break;
        case "checkAcountInfos":
            checkAcountInfos();
            break;
        case "filterFood":
            filterFood();
            break;
        case "addToCart":
            addToCart();
            break;
        case "getCartHtml":
            getCartHtml();
            break;
        case "delFromCart":
            delFromCart();
            break;
        case "getTotalQte":
            getTotalQte();
            break;
        case "Reservation":
            reservationRouter();
            break;
        case "checkDateVsTime":
            checkDateVsTime();
            break;
        case "VRI":
            VRI();
            break;
        case "PAY":
            PAYdisplay();
            break;
        case "CHECK":
            CHECKdisplay();
            break;
        case "prepareReservation":
            prepareReservation();
            break;
        case "paymentProcess":
            paymentProcess();
            break;
        case "ThankYou":
            thankYou();
            break;
        case "failedPAY":
            failedPAY();
            break;
        case "storeResrvation":
            storeResrvation();
            break;
        case "Treview":
            getTreview();
            break;
        case "gallery":
            galleryRouter();
            break;
        case "fetchGallery":
            fetchGallery();
            break;
        case "AboutUs":
            AboutRouter();
            break;
        case "FeedBack":
            feedback();
            break;
        case "Expired":
            Expired();
            break;
        case "addReview" :
            addReview();
            break;
    }
}





// rounting functions 
function homeRouter()
{
    require 'controller/Homecontroller.php';
    indexAction();
}

function getTreview()
{
    require 'controller/Homecontroller.php';
    getReview();
}

function galleryRouter()
{
    require 'controller/galleryController.php';
    session_start();
    displayGalleryAction();
}

function AboutRouter()
{
    require 'controller/AboutController.php';
    session_start();
    displayAboutPage();
}

function SignUpRouter()
{
    require 'controller/SignUpController.php';
    displaySignUpPageAction();
}


function checkSignUp()
{
    require 'controller/SignUpController.php';
    checkSignUpAction();
}

function verifyEmailRouter()
{
    require 'controller/emailVerififcationController.php';
    DisplayEVAction();
}

function sendConfirmationEmail()
{
    require 'controller/emailVerififcationController.php';
    sendConfiEmail();
    DisplayEVAction();
}

function checkConfirmationCode()
{
    require 'controller/emailVerififcationController.php';
    checkVerificationCode();
}


// store client in database 

function CreateClientRouter()
{
    require_once 'controller/clientStronigController.php';
    createClient();
}

// SUC and ERR pages 
function displayERR()
{
    require_once 'controller/ErrsController.php';
    displayErrAction();
}

function displaySUC()
{
    require_once 'controller/ErrsController.php';
    displaySUCAction();
}

// Logout

function logout()
{
    session_start();
    if (isset($_SESSION['idClient'])) {
        unset($_SESSION['idClient']);
        setcookie("id", "", time() - 3600, "/", null, true, true);
        header('location:Home');
    }
}

//login

function loginView()
{
    require 'controller/loginController.php';
    displayLoginAction();
}

function checkLogin()
{
    session_start();
    require 'controller/loginController.php';
    checkSignUpAction();
}

// forget pass 
function forgetpassword()
{
    require 'controller/forgetPasscontroller.php';
    Displayforgetpassword();
}


function checkGmail()
{
    require 'controller/forgetPasscontroller.php';
    checkGmailAction();
}

function verifyG()
{
    require 'controller/forgetPasscontroller.php';
    session_start();
    checkgmailcodeAction();
}


function sendGVcode()
{
    require 'controller/forgetPasscontroller.php';
    sendGVC();
    displayGConfirmationAction();
}

function newPasword()
{
    require 'controller/forgetPasscontroller.php';
    displayNewPassAction();
}

function passValidity()
{
    require 'controller/forgetPasscontroller.php';
    checkPassValidity();
}

function updatePass()
{
    require 'controller/clientStronigController.php';
    if (updatePassword()) header('location:Home');
    else header('location:err');
}



function manageDispay()
{
    session_start();
    require 'controller/manageAcountController.php';
    $reservations = getClientReservations();
    $client = getDetails();
    dipslayManage($client, $reservations);
}

function checkAcountInfos()
{
    session_start();
    require 'controller/manageAcountController.php';
    checkAcountInfosAction();
}

function MenuRouter()
{
    session_start();
    require 'controller/MenuController.php';
    displayMenuPageAction();
}


function filterFood()
{
    require 'controller/MenuController.php';
    filterFoodAction();
}


function addToCart()
{
    session_start();
    require 'controller/MenuController.php';
    addToCartAction();
}

function getCartHtml()
{
    session_start();
    require 'controller/CartContoller.php';
    displayCart();
}

function delFromCart()
{
    session_start();
    require 'controller/CartContoller.php';
    delcart();
}

function getTotalQte()
{
    require 'controller/CartContoller.php';
    session_start();
    getTotalQtee();
}

function reservationRouter()
{
    require 'controller/reservationController.php';
    session_start();
    displayReservationAction();
}


function checkDateVsTime()
{
    require 'controller/reservationController.php';
    getTimeSelectors();
}

function VRI()
{
    require 'controller/reservationController.php';
    session_start();
    ValidateRI();
}

function PAYdisplay()
{
    require 'controller/PAYcontroller.php';
    displayPAYAction();
}


function CHECKdisplay()
{
    require 'controller/PAYcontroller.php';
    session_start();
    CHECKdisplayAction();
}


function prepareReservation()
{
    require 'controller/reservationController.php';
    session_start();
    prepReservation();
}

function paymentProcess()
{
    require 'controller/PAYcontroller.php';
    session_start();
    handlePayement();
}

function thankYou()
{
    require 'view/Err404/ThankYou.php';
}

function failedPAY()
{
    require 'view/Err404/failed.php';
}


function storeResrvation()
{
    require 'controller/reservationController.php';
    session_start();
    storeReserrvationDetails();
}

function fetchGallery()
{
    require 'controller/galleryController.php';
    getGalleryPage();
}


function feedback()
{
    require 'controller/ReviewsController.php';
    displayFeedback();
}


function Expired()
{
    require 'controller/ErrsController.php';
    displayExpired();
}

function addReview(){
    require 'controller/ReviewsController.php';
    session_start();
    setReview();
}