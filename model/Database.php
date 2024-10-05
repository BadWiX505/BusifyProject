<?php 

use app\model\Client;
use app\model\Food;
use app\model\Promo;
use app\model\Cart;
use app\model\Reservation;
use app\model\Order;
use app\model\Chef;
use app\model\TextReview;
use app\model\Gallery;


require 'model/Cart.php';
require 'model/Food.php';
require 'model/Chef.php';
require 'model/TextReview.php';
require 'model/Gallery.php';

class Database {
    private static $instance;
    private $connection;

    private function __construct() {
        try {
            $this->connection = new PDO('mysql:host=localhost;dbname=RestaurantDB', 'root', '');
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
              header('location:err');
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    
    //Insert client to database
    public function InsertClient(Client $client){
        $database = Database::getInstance();
        $data = $client->toDatabaseArray();
        $pdo = $database->getConnection();
        $sql = 'INSERT INTO client (client_F_Name, client_L_Name, Email, Passwd, Image, Action_Date)
        VALUES (:client_F_Name, :client_L_Name, :Email, :Passwd, :Image, NOW())';
        $stm = $pdo->prepare($sql);
        foreach ($data as $key => $value) {
            $stm->bindValue(':' . $key, $value);
        }
       $res =  $stm->execute();
       if(!$res){
        return false;
       }
       else{
            return $this->setIdSessionUsingEmail($client->getEmail());
    }
    

}


// set ID client in SESSION for navigation
public function setIdSessionUsingEmail($email){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql= 'SELECT id_Client FROM client WHERE Email= :email';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':email',$email);
    $stm->execute();
     // Fetch the result (single row)
   $row = $stm->fetch(PDO::FETCH_ASSOC);
  if ($row) {
      $_SESSION['idClient'] = $row['id_Client'];
      return true;
  } else {
      return false;
  }
}

// get ID using email to use it 
public static function getIdfromemail($email){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql= 'SELECT id_Client FROM client WHERE Email= :email';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':email',$email);
    $stm->execute();
     // Fetch the result (single row)
   $row = $stm->fetch(PDO::FETCH_ASSOC);
  if ($row) {
      return $row['id_Client'];
  } else {
      return null;
  }
}


// check if login infos are correct or not
public function checklogin(Client $client){
   
    if ($this->checkEmail($client->getEmail())) {
      if($this->verifyPassFromGmail($client->getEmail(),$client->getPassword())){
        return $this->setIdSessionUsingEmail($client->getEmail());
      }
      return false;
 
   } else {
       return false;
   }
}

// check email if it is exists or not 
public static function checkEmail($email){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql= 'SELECT Email FROM client WHERE Email= :email';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':email',$email);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return true;
    }
   return false;
}


// verify password 
public function verifyPassFromGmail($email,$pass){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql= 'SELECT Passwd FROM client WHERE Email= :email';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':email',$email);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_ASSOC);

  if ($row) {
       $gettenPass = $row['Passwd'];
       if(password_verify($pass,$gettenPass)){
        return true;
       }
       return false;

  } else {
      return false;
  }
}


// Update password 
  public function updatePasswd(Client $client){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='UPDATE client set Passwd=:passwd WHERE email=:email';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':email',$client->getEmail());
    $stm->bindValue(':passwd',$client->getPassword());
    if ($stm->execute()) {
        return true; // Operation successful
    } else {
        return false;
    }
  }



  // get clientDetails 

  public function getClientDetails($id){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='SELECT * FROM client WHERE id_Client=:id';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id',$id);
    $stm->execute();
    $row=$stm->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      return new Client($row['id_Client'], $row['client_F_Name'], $row['client_L_Name'], $row['Email'], $row['Passwd'], $row['Image'], $row['Action_Date']);
    } else {
        return null;
    }

  }



  //get pass using ID 
  public static function getclientPass($id){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='SELECT Passwd FROM client WHERE id_Client=:id';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id',$id);
    $stm->execute();
    $row=$stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['Passwd'];
    }
    else{
        return null;
    }
  }



  // Update Client 
  public function UpdateClient(Client $client){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $imageQuery='';
    if($client->getImage()!=null){
     $imageQuery=',Image=:image';
    }

    if($client->getPassword()!='')
    $sql='UPDATE client set Passwd=:pass , client_F_Name=:fname, client_L_Name=:lname '.$imageQuery.' WHERE id_Client=:id';
    else
    $sql='UPDATE client set  client_F_Name=:fname, client_L_Name=:lname '.$imageQuery.' WHERE id_Client=:id';

    $stm = $pdo->prepare($sql);
    if($client->getPassword()!=''){
    $stm->bindValue(':pass',$client->getPassword());
    }
    $stm->bindValue(':fname',$client->getFirstName());
    $stm->bindValue(':lname',$client->getLastName());
    if($client->getImage()!=null){
    $stm->bindValue(':image',$client->getImage(),PDO::PARAM_LOB);
    }
    $stm->bindValue(':id',$client->getId());

    if ($stm->execute()) {
        return true; // Operation successful
    } else {
        return false;
    }
  }


  //////////////////////////////////////////////////// Food transactions /////////////////////////////////////////////////////

  // get Promo based on idFood
public static function getPromoFromFoodId($idFood){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='SELECT * FROM promotion WHERE id_Food=:id';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id',$idFood);
    $stm->execute();
    $row=$stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return new Promo($row['id_Promo'],$row['discount']);
    }
    else{
        return null;
    }
}



// get Food details based on parameters 

public static function FoodList($goal,$goalId){
    $subquery = '';

    switch($goal){
        case 'all' : $subquery='' ; break;
        case 'promo' : $subquery='and food.isInPromo=1'; break ;
        case 'ID'  : $subquery = "and food.idFood=$goalId"; break;
        default : $subquery = $goal; break;
    }
    $promoFoodList=null;
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='SELECT idFood, foodName, price, food_description, reviews, isInPromo, isAvailable, action_Date, categorie.name as cat, mealTime.name as mel, Subcategorie.name as sub ,Image

    FROM food
    
    JOIN categorie on food.id_categorie=categorie.id_categorie
    JOIN subcategorie on food.id_Subcategorie=subcategorie.id_Subcategorie
    JOIN mealtime on food.id_mealTime=mealtime.id_mealTime
    
    WHERE 1=1 
    and food.isAvailable=1   
    '.$subquery.'
    ';

    $stm = $pdo->prepare($sql);
    $stm->execute();
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        list($idFood, $foodName, $price, $foodDescription, $reviews, $isItPromo, $isItAvailable, $actionDate, $Categorie, $MealTime, $SubCategorie,$image) = array_values($row);

        $promo =  Database::getPromoFromFoodId($idFood);
       $food = new Food($idFood, $foodName, $price, $foodDescription,$reviews,boolval($isItPromo),boolval($isItAvailable), $actionDate, $Categorie, $MealTime, $SubCategorie,$promo,$image);
        $promoFoodList[]= $food;
    }

    return $promoFoodList;
    
}



// get Qte of food based on client

public static function getCartQte($idClient)
{
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='SELECT sum(Qte) as total , id_client from cart GROUP BY id_client HAVING id_client=:id;';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id',$idClient);
    $stm->execute();
    $row=$stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['total'];
    }
    else{
        return 0;
    }
}


// // add food to cart
public function foodToCart(Cart $cart){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='INSERT INTO cart (id_client,id_food,Qte)
    VALUES (:id_client, :idFood, :qte)
    ON DUPLICATE KEY UPDATE Qte = Qte + :qte;
    ';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id_client',$cart->getClient()->getId());
    $stm->bindValue(':idFood',$cart->getFood()->getIdFood());
    $stm->bindValue(':qte',$cart->getQte());
    if($stm->execute()){
        return true;
    }
    else{
        return false;
    }
}




// get the cart list of a specific client
public function getCartDetails($idC){
    $cartList=null;
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='SELECT * from cart WHERE id_client=:id;';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':id',$idC);
    $stm->execute();
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
       
        list($idClient,$idFood,$qte)=array_values($row);
        $food = $this->FoodList('ID',$idFood);
        $cartList[]=new Cart($food[0],$qte);
    }
    
    return $cartList;

}

// delete From cart 

public function removeFromCart($idClient,$idFood){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='DELETE FROM cart WHERE id_client=:idC and id_Food=:idF;';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':idC',$idClient);
    $stm->bindValue(':idF',$idFood);
    
    if($stm->execute()){
        return true;
    }
    else{
        return false;
    }

}


public function voidingcart($idClient){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='DELETE FROM cart WHERE id_client=:idC;';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':idC',$idClient);
    
    if($stm->execute()){
        return true;
    }
    else{
        return false;
    }
}



/////////////// Reservation Field ///////////////////////////////////////////////////////////////////////////////////////////

public static function selectNotAvailableTimes($date){
    $Times=[];
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='SELECT Time,COUNT(id_Reservation) as ResevationsNumber FROM reservation where date=:date GROUP BY Time HAVING ResevationsNumber>=15';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':date',$date);
    $stm->execute();
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        $Times[]=$row['Time'];
    }
    
    return $Times;

}


public function insertReservationDetails(Reservation $reservation){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $stmt = $pdo->prepare("INSERT INTO reservation (id_client, date, Time, persons, Phone, id_Status, action_Time,isEmailSent,isExpired) VALUES (:id_client, :date, :Time, :persons, :Phone, :id_Status, NOW(),0,0)");
    // Bind values
    $stmt->bindValue(':id_client', $reservation->getClient()->getId()); // Example client ID
    $stmt->bindValue(':date', $reservation->getDate());
    $stmt->bindValue(':Time', $reservation->getTime());
    $stmt->bindValue(':persons', $reservation->getPersons());
    $stmt->bindValue(':Phone', $reservation->getPhone());
    $stmt->bindValue(':id_Status', $reservation->getStatus());

    if($stmt->execute()){
        $id_reservation = $pdo->lastInsertId();
        $reservation->setIdReservation($id_reservation);
        $orders = $reservation->getOrder();
        foreach($orders as $order){
            if($this->insertOrderDetails($order)){
             $this->insertOrderResDetails($reservation->getIdReservation(),$order->getIdOrder());
            }
        }
        if($reservation->getStatus()===1){
        if($this->insertIntoPayment($reservation->getIdReservation(),$_SESSION['payID'])){
            if($reservation->getClient()->voidCart()){
                return true;
            }
        }
        else{
            return false;
        }
    }

    return true;
   
    }
    else
    header('location:err');
}

public function insertOrderDetails(Order $order){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $stmt = $pdo->prepare("INSERT INTO `Order` (id_Food, Qte, order_Total_Price) VALUES (:id_Food, :Qte, :order_Total_Price)");

    // Bind values
    $stmt->bindValue(':id_Food', $order->getFood()->getIdFood()); // Example food ID
    $stmt->bindValue(':Qte', $order->getQte()); // Example quantity
    $stmt->bindValue(':order_Total_Price', $order->getTotalPrice()); // Example total price
    if($stmt->execute()){
        $id_Order = $pdo->lastInsertId();
        $order->setIdOrder($id_Order);
        return true;
    }
    header('location:err');
}


public function insertOrderResDetails($idres,$idorder){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $stmt = $pdo->prepare("INSERT INTO Reservation_Order (id_Reservation, id_Order) VALUES (:id_Reservation, :id_Order)");

    // Bind values
    $stmt->bindValue(':id_Reservation', $idres); // Example reservation ID
    $stmt->bindValue(':id_Order', $idorder); // Example order ID
    if($stmt->execute()){
        return true;
    }
    header('location:err');
}



public function insertIntoPayment($idres,$payId){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $stmt = $pdo->prepare("INSERT INTO `payment`(`id_Reservation`, `id_Payment`) VALUES (:idres,:idPayId)");
    $stmt->bindValue(':idres', $idres); // Example reservation ID
    $stmt->bindValue(':idPayId', $payId); // Example order ID
    if($stmt->execute()){
        return true;
    }
    header('location:err');

}


public static function getReservationDetails($idC){
    $reservations = [];
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='SELECT id_Reservation, id_client, date, Time, persons, Phone, status.status FROM reservation 
    JOIN status on status.id_status=reservation.id_Status
    WHERE reservation.id_client=:idC
    ';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':idC',$idC);
    $stm->execute();
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        $reservation = new Reservation(null,null.null.null,null,null,null,null,null,null,null);
        $reservation->setIdReservation($row['id_Reservation']);
        $reservation->setDate($row['date']);
        $reservation->setTime($row['Time']);
        $reservation->setPersons($row['persons']);
        $reservation->setPhone($row['Phone']);
        $reservation->setStatus($row['status']);
        $reservation->TP = self::getReservationTP($reservation->getIdReservation());
        // Assuming you have setters for all attributes in the Reservation class
    
        $reservations[] = $reservation;
    }
    
    
    return $reservations;

}

public static function getReservationTP($idR){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='SELECT SUM(order.order_Total_Price) AS TP, reservation_order.id_Reservation
    FROM `order`
    JOIN reservation_order ON reservation_order.id_Order = `order`.id_Order
    WHERE reservation_order.id_Reservation = :idR
    GROUP BY reservation_order.id_Reservation;    
    ';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':idR',$idR);
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['TP'];
    }
    return 0;
}



//////////////////////////Home and chefs staff ///////////////////////////////////////////////////////////////////////////////////////////////////////

public static function getNewFood(){
    $newFoods = [];
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql='SELECT * FROM `food` WHERE  food.isAvailable=1 ORDER BY food.action_Date DESC LIMIT 5;';
    $stm = $pdo->prepare($sql);
    $stm->execute();
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
       $food = new Food($row['idFood'],$row['foodName'],null,null,null,null,null,null,null,null,null,null,$row['Image']);
       $newFoods[]=$food;
    }
    return $newFoods;
}


public static function getAllChefs($par='all') {
    if($par!='all') {
        $par='LIMIT 3';
    }
    else {
        $par=''; 
    }
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql = "SELECT * FROM chef $par;";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $chefs = [];
    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
        $chef = new Chef(
            $row['id_Chef'],
            $row['chef_fullName'],
            $row['level'],
            $row['fb'],
            $row['in'],
            $row['ig'],
            $row['image']
        );
        $chefs[] = $chef;
    }
    
    return $chefs;
}



public static function getreview($page){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql = "SELECT id_text_Review, id_client, description, textstatus.value as status FROM text_review
    JOIN textstatus on text_review.id_status = textstatus.id_review_status
    WHERE textstatus.value='confirmed'
    LIMIT 1
    OFFSET $page;";

     $stm = $pdo->prepare($sql);
     $stm->execute();
    if($row = $stm->fetch(PDO::FETCH_ASSOC)) {
         // Assuming Client class is available
        $client = new Client($row['id_client'],null,null,null,null,null,null); // You need to define how to create a Client object
        $client = $client->getDetails($client->getId());
         // Create a new TextReview object
         $textReview = new TextReview(
             $row['id_text_Review'],
             $row['description'],
             $client,
             $row['status']
         );
     
         return $textReview; 
     }

     return null;
}


//////////////////////////////////////////////////////Gallery ///////////////////////////////////////////////////

public static function getGallery($page){
    $gallery=[];
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql="SELECT * FROM gallery LIMIT 12 OFFSET $page ";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    while($row =  $stm->fetch(PDO::FETCH_ASSOC)){
      $gallery[] = new Gallery($row['id_Image'],$row['image'],$row['description']);
    }
    return $gallery;
}


//////////////////////////////////////////////////////AboutUs //////////////////////////////////////////////////////////////





////////////////////////////////////////////////////  Statistics /////////////////////////////////////////////////////////////

public static function getNclients(){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql="SELECT COUNT(client.id_Client) as clientsNumber FROM client";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $row =  $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['clientsNumber'];
    }
    else{
        return 0;
    }
}


public static function getLastReservations(){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql="SELECT COUNT(reservation.id_Reservation) as totalRes 
    FROM reservation 
    WHERE reservation.action_Time >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK) 

    ";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $row =  $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['totalRes'];
    }
    else{
        return 0;
    }
}


public static function getNChefs(){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql="SELECT COUNT(chef.id_Chef) as chefsN  FROM chef";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $row =  $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['chefsN'];
    }
    else{
        return 0;
    }
}


public static function getNDishes(){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql="SELECT COUNT(food.idFood) as TotalFood FROM food WHERE food.isAvailable=1";
    $stm = $pdo->prepare($sql);
    $stm->execute();
    $row =  $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return $row['TotalFood'];
    }
    else{
        return 0;
    }
}



public static function getAllStatistics(){
    $clients = self::getNclients();
    $reservations = self::getLastReservations();
    $chefs = self::getNChefs();
    $dishes = self::getNDishes();
   $statistics = [
    'clients' => $clients,
    'reservations' => $reservations,
    'chefs' => $chefs,
    'dishes' => $dishes
   ];
   return  $statistics;
}


//////////////////////////////Review FACT////////////////////////////////////////////

public static function getFoodsFromReservation($idR){
    $database = Database::getInstance();
    $foods=null;
    $pdo = $database->getConnection();
    $sql='SELECT 
    food.idFood AS idFood, 
    food.foodName AS foodName, 
    food.Image AS foodImage 
FROM 
    reservation
    JOIN reservation_order ON reservation_order.id_Reservation = reservation.id_Reservation
    JOIN `order` ON `order`.id_Order = reservation_order.id_Order
    JOIN food ON `order`.id_Food = food.idFood
WHERE 
    reservation.id_Reservation = :idR;

    ';
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':idR',$idR);
    $stm->execute();
    while($row=$stm->fetch(PDO::FETCH_ASSOC)){
        $foods[]=new Food($row['idFood'],$row['foodName'],null,null,null,null,null,null,null,null,null,null,$row['foodImage']);
    }
    return $foods;
   
  }
  


public static function checkReservationIsExprired($idR){
      $database = Database::getInstance();
    $pdo = $database->getConnection();
    $sql="SELECT isExpired from reservation where reservation.id_Reservation=:idR";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':idR',$idR);
    $stm->execute();
    $row =  $stm->fetch(PDO::FETCH_ASSOC);
    if($row){
        return boolval($row['isExpired']);
    }
    else{
        return false;
    }
}



public static function putRev($idC,$idF,$rating){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $stmt = $pdo->prepare("INSERT INTO review (id_Client, id_Food, stars_Number)
    VALUES (:idC,:idF,:Rt)
    ON DUPLICATE KEY UPDATE
        stars_Number = VALUES(stars_Number);
    ");

    $stmt->bindValue(':idC', $idC); 
    $stmt->bindValue(':idF', $idF); 
    $stmt->bindValue(':Rt', $rating); 
    if($stmt->execute()){
        return true;
    }
    header('location:err');
}


public static function insertComment($idC,$comment){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $stmt = $pdo->prepare("
    INSERT INTO text_review (id_client, description, id_status)
      VALUES (:idC, :comment,2);
    ;
    ");

    $stmt->bindValue(':idC', $idC); 
    $stmt->bindValue(':comment', $comment); 
    if($stmt->execute()){
        return true;
    }
    header('location:err');
}



public static function setToExpired($idR){
    $database = Database::getInstance();
    $pdo = $database->getConnection();
    $stmt = $pdo->prepare("
      UPDATE reservation set reservation.isExpired=1 where reservation.id_Reservation=:idR;
    ;
    ");

    $stmt->bindValue(':idR', $idR); 
    if($stmt->execute()){
        return true;
    }
}




}






















?>