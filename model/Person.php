<?php
namespace app\model ;

class Person {
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $image;
    private $actionTime;

    // Constructor
    public function __construct($firstName, $lastName, $email, $password, $image, $actionTime) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
        $this->actionTime = $actionTime;
    }

    // Getter and setter methods for each property (you can generate these automatically in some IDEs)

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getActionTime() {
        return $this->actionTime;
    }

    public function setActionTime($actionDate) {
        $this->actionTime = $actionDate;
    }
}
