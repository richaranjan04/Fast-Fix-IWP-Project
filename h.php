<?php
session_destroy();

if(empty($_SESSION['username'])){
 header('location:login.php');
}




?>