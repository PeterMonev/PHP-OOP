<?php
require_once '../models/Database.php';
require_once '../models/User.php';
require_once '../models/UserManagement.php';

session_start(); // Starts the session

function isValidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    $pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
    return preg_match($pattern, $email);
}

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
            if (empty($username) || empty($password) || empty($email)) {
                throw new Exception("All fields are required!");
            }


            // Validate email format
            if (!isValidEmail($email)) {
                throw new Exception("Invalid email format.");
            }

            if (strlen($password) < 3) {
                throw new Exception("Password should be at least 3 characters long!");
            }

            if ($userManager->doesEmailExist($email)) {
                throw new Exception("Email already registered!");
            }

            $user = new User(null, $username, $password, $email, $role);

            if (!$userManager->addUser($user)) {
                throw new Exception("There was an error registering the user.");
            }

            header("Location: ../views/loginView.php");
            exit;
        }

        // Login logic
        if (isset($_POST['login'])) {
            // Input validation
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Check if email or password fields are empty
            if (empty($email) || empty($password)) {
                throw new Exception("Email and password are required.");
            }

            // Validate email format
            if (!isValidEmail($email)) {
                throw new Exception("Invalid email format.");
            }

            $userData = $userManager->getUserByEmail($email);

            if ($userData && password_verify($password, $userData->getPassword())) {
                $_SESSION['user_id'] = $userData->getId();
                header("Location: ../views/profileView.php");
                exit;
            } else {
                throw new Exception("Invalid login.");
            }
        }

   
        

    } catch (Exception $error) {
        $_SESSION['error'] = $error->getMessage();
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}

     // Logout logic
     if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        session_unset();
        session_destroy();
        header("Location: ../views/loginView.php");
        exit;
    }