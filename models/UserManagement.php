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
        return !empty($users) ? new User($users[0]['id'], $users[0]['username'], $users[0]['password'], $users[0]['email'], $users[0]['role']) : null;
    }
    

    public function updateUser(User $user) {
        return $this->database->updateUser($user->getId(), $user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getRole());
    }

    public function deleteUser($id) {
        return $this->database->deleteUser($id);
    }

    public function doesEmailExist($email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $users = $this->database->query($query, [':email' => $email]);
        return !empty($users); // returns true if email exists, false otherwise
    }
}

?>
