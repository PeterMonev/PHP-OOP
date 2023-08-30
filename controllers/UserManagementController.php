<?php

// UserController.php
require_once '../models/Database.php';
require_once '../models/User.php';
require_once '../models/UserManagement.php';

class UserManagementController {
    private $userManagement;

    public function __construct() {
        $this->userManagement = new UserManagement();
    }

    public function getAllUsers() {
        return $this->userManagement->getAllUsers();
    }

    public function deleteUserById($id) {
        return $this->userManagement->deleteUser($id);
    }

    public function updateUser($id, $username, $email, $role) {
        $user = $this->userManagement->readUser($id);
        if ($user) {
            return $this->userManagement->updateUser($id, $username, password_hash("", PASSWORD_BCRYPT), $email, $role);
        }
        return false;
    }
}

if (isset($_GET['delete'])) {
    $idToDelete = $_GET['delete'];
    $controller = new UserManagementController();
    if ($controller->deleteUserById($idToDelete)) {
        header('Location: ../views/adminView.php');
        exit;
    } else {
        die('Failed to delete user with ID: ' . $idToDelete); 
    }
}



?>