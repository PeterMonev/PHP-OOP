<?php
require_once '../models/Database.php';
require_once '../models/User.php';
require_once '../models/UserManagement.php';



session_start(); // Starts the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
    $userManager = new UserManagement();
    
    // Registration logic
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = 'user'; // Default role you 

        // Regisuter Input field validation
        if(empty($username) || empty($password) || empty($email)) {
            throw new Exception("All fields are required!");
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format!");
        }

        if (strlen($password) < 3) {
            throw new Exception("Password should be at least 3 characters long!");
        }

        if($userManager->doesEmailExist($email)) {
            throw new Exception("Email already registered!");
        }

        $user = new User(null, $username, $password, $email, $role);

        if (!$userManager->addUser($user)) {
            throw new Exception("There was an error registering the user.");
        }
        
        header("Location: ../views/loginView.php");
        exit;
    }


    } catch (Exception $error){
        $_SESSION['error'] = $error->getMessage();
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;

    }
}

