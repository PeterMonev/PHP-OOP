<?php 
session_start();
include('../includes/header.php');
echo $_SESSION['user_id'];
echo $_SESSION['role'];


?>