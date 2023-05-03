<?php
session_start();

if(isset($_SESSION['auth_user'])){
    header("Location:index.php");
}

session_destroy();

header("Location:signin.php");

?>
