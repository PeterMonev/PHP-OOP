<?php 

function isRoleAdmin(){
  return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isRoleUser(){
  return isset($_SESSION['user_id']);
}

?>