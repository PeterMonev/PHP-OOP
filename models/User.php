<?php 

class User {
    private $id;
    private $username;
    private $password;
    private $email;
    private $role;

    public function __construct($id, $username, $password, $email, $role){
        $this->id = $id;
        $this->username = $username;
        $this->setPassword($password);
        $this->email = $email;
        $this->role = $role;
    }

    // Getters
    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getRole(){
        return $this->role; 
    }

    // Setters
    private function setUsername($username){
        $this-> username = $username;
    }

    private function setPassword($password){
        $this-> password = password_hash($password, PASSWORD_BCRYPT);
    }

    private function setEmail($email){
        $this->email = $email;
    }

    private function setRole($role){
        $this->role = $role;
    }

}

?>