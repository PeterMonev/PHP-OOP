<?php

require_once 'User.php';
require_once 'Database.php';

class UserManagement {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function addUser(User $user) {
        return $this->database->createUser($user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getRole());
    }

    public function getUserById($id) {
        $userData = $this->database->readUser($id);
        if ($userData) {
            return new User($userData['id'], $userData['username'], $userData['password'], $userData['email'], $userData['role']);
        }
        return null;
    }

    public function updateUser(User $user) {
        return $this->database->updateUser($user->getId(), $user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getRole());
    }

    public function deleteUser($id) {
        return $this->database->deleteUser($id);
    }
}

?>
