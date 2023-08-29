<?php
require_once '../models/Database.php';
require_once '../models/User.php';
require_once '../models/UserManagement.php';

class AuthenticaitonController {
    private $userManager;

    public function __construct() {
        session_start();
        $this->userManager = new UserManagement();
    }

    private function isValidEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
        return preg_match($pattern, $email);
    }

    public function register() {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $role = 'user';

            if (empty($username) || empty($password) || empty($email)) {
                throw new Exception("All fields are required!");
            }

            if (!$this->isValidEmail($email)) {
                throw new Exception("Invalid email format.");
            }

            if (strlen($password) < 3) {
                throw new Exception("Password should be at least 3 characters long!");
            }

            if ($this->userManager->doesEmailExist($email)) {
                throw new Exception("Email already registered!");
            }

            $user = new User(null, $username, $password, $email, $role);

            if (!$this->userManager->addUser($user)) {
                throw new Exception("There was an error registering the user.");
            }

            header("Location: ../views/loginView.php");
            exit;
        } catch (Exception $error) {
            $_SESSION['error'] = $error->getMessage();
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function login() {
        try {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {
                throw new Exception("Email and password are required.");
            }

            if (!$this->isValidEmail($email)) {
                throw new Exception("Invalid email format.");
            }

            $userData = $this->userManager->getUserByEmail($email);

            if ($userData && password_verify($password, $userData->getPassword())) {
                $_SESSION['user_id'] = $userData->getId();
                $_SESSION['role'] = $userData->getRole();

                if($userData->getRole() === 'user'){
                    header("Location: ../views/profileView.php");
                } else {
                    header("Location: ../views/adminView.php");
                }
                exit;
            } else {
                throw new Exception("Invalid email or password.");
            }
        } catch (Exception $error) {
            $_SESSION['error'] = $error->getMessage();
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../views/loginView.php");
        exit;
    }
}

// Using the class
$auth = new AuthenticaitonController();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $auth->register();
    }
    if (isset($_POST['login'])) {
        $auth->login();
    }
}
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $auth->logout();
}
