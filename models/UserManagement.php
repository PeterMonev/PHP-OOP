<?php

require_once '../models/Database.php';
require_once '../models/User.php';

class UserManagement {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function addUser(User $user) {
        return $this->database->createUser($user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getRole());
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $users = $this->database->query($query, [':email' => $email]);

        if (!empty($users)) {
            $user = new User($users[0]['id'], $users[0]['username'], "", $users[0]['email'], $users[0]['role']);
            $user->setHashedPassword($users[0]['password']);
            return $user;
        }

        return null;
    }

 
    public function readUser($id) {
           $query = "SELECT * FROM users WHERE id = :id";
           $users = $this->database->query($query, [':id' => $id]);
           return !empty($users) ? $users[0] : null;
}


   public function updateUser(User $user) {
    $query = "UPDATE users SET username = :username, email = :email, role = :role WHERE id = :id";
    $params = [
        ':id' => $user->getId(),
        ':username' => $user->getUsername(),
        ':email' => $user->getEmail(),
        ':role' => $user->getRole()
    ];
    return $this->database->execute($query, $params);
}

    public function deleteUser($id) {
        return $this->database->deleteUser($id);
    }

    public function doesEmailExist($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $users = $this->database->query($query, [':email' => $email]);
        return !empty($users); // returns true if email exists, false otherwise
    }

    public function getAllUsers() {
        $query = "SELECT * FROM users";
        return $this->database->query($query);
    }
}
