<?php 
session_start();
include('../includes/header.php');
echo $_SESSION['user_id'];


if (!isRoleUser() || isRoleAdmin()) {
    header('Location: ../views/loginView.php');
    exit;
}
?>