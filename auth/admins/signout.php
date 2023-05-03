<?php
session_start();

if(!isset($_SESSION['auth_user'])){
    header("Location:signin.php");
}

session_destroy();

header("Location:signin.php");

?>
