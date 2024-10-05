<?php 

namespace app\model;
use Database;
require 'model/Client.php';
require 'model/Order.php';
class Reservation {
    private $idReservation; // int
    private $Date; // date
    private $Time; // time
    private $Persons; // int
    private $Phone; // String
    private $Status; // String
    private $order; // Order
    private $client; // Client
    private $Actiondate; // dateTime
    public $TP;



    public function __construct($idReservation, $Date, $Time, $Persons, $Phone, $Status, $order, $client, $Actiondate) {
        $this->idReservation = $idReservation;
        $this->Date = $Date;
        $this->Time = $Time;
        $this->Persons = $Persons;
        $this->Phone = $Phone;
        $this->Status = $Status;
        $this->order = $order;
        $this->client = $client;
        $this->Actiondate = $Actiondate;
    }

    
    // Getter and Setter methods for idReservation
    public function getIdReservation() {
        return $this->idReservation;
    }

    public function setIdReservation($idReservation) {
        $this->idReservation = $idReservation;
    }

    // Getter and Setter methods for Date
    public function getDate() {
        return $this->Date;
    }

    public function setDate($Date) {
        $this->Date = $Date;
    }

    // Getter and Setter methods for Time
    public function getTime() {
        return $this->Time;
    }

    public function setTime($Time) {
        $this->Time = $Time;
    }

    // Getter and Setter methods for Persons
    public function getPersons() {
        return $this->Persons;
    }

    public function setPersons($Persons) {
        $this->Persons = $Persons;
    }

    // Getter and Setter methods for Phone
    public function getPhone() {
        return $this->Phone;
    }

    public function setPhone($Phone) {
        $this->Phone = $Phone;
    }

    // Getter and Setter methods for Status
    public function getStatus() {
        return $this->Status;
    }

    public function setStatus($Status) {
        $this->Status = $Status;
    }

    // Getter and Setter methods for order
    public function getOrder() {
        return $this->order;
    }

    public function setOrder($order) {
        $this->order = $order;
    }

    // Getter and Setter methods for client
    public function getClient() {
        return $this->client;
    }

    public function setClient($client) {
        $this->client = $client;
    }

    // Getter and Setter methods for Actiondate
    public function getActiondate() {
        return $this->Actiondate;
    }

    public function setActiondate($Actiondate) {
        $this->Actiondate = $Actiondate;
    }

    public function insertMyDetails(){
        $database = Database::getInstance();
        return $database->insertReservationDetails($this);
    }

    
}




?>