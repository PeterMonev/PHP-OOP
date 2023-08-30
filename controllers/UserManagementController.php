<?php

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
        if (!is_numeric($id)) {
            throw new Exception('Invalid user ID');
        }

        return $this->userManagement->deleteUser($id);
    }

    public function updateUser($id, $username, $email, $role) {
        if (!is_numeric($id) || empty($username) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($role)) {
            throw new Exception('Invalid input data');
        }

        $user = new User($id, $username, '', $email, $role);  
        return $this->userManagement->updateUser($user);
    }
    
}

// Using the class
try {
    // Admin Delete Task
    if (isset($_GET['delete'])) {
        $idToDelete = filter_input(INPUT_GET, 'delete', FILTER_SANITIZE_NUMBER_INT);
        
        if ($idToDelete === false) {
            throw new Exception('Invalid ID');
        }

        $controller = new UserManagementController();

        if ($controller->deleteUserById($idToDelete)) {
            header('Location: ../views/adminView.php');
            exit;
        } else {
            throw new Exception('Failed to delete user with ID: ' . $idToDelete);
        }
    }

    // Admin Edit logic
    if (isset($_POST['edit'])) {
        $idToEdit = filter_input(INPUT_POST, 'editUserId', FILTER_SANITIZE_NUMBER_INT);
        $newUsername = filter_input(INPUT_POST, 'editUsername');
        $newEmail = filter_input(INPUT_POST, 'editEmail', FILTER_SANITIZE_EMAIL);
        $newRole = filter_input(INPUT_POST, 'editRole');

        if (!$idToEdit || !$newUsername || !$newEmail || !$newRole) {
            throw new Exception('Invalid input data for editing');
        }

        $controller = new UserManagementController();

        if ($controller->updateUser($idToEdit, $newUsername, $newEmail, $newRole)) {
            header('Location: ../views/adminView.php');
            exit;
        } else {
            throw new Exception('Failed to edit user with ID: ' . $idToEdit);
        }
    }
    

} catch (Exception $error) {
    $_SESSION['error'] = $error->getMessage();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
