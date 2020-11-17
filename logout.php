<?php 
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: register.php");
}


if (isset($_GET['logout'])) {
        unset($_SESSION['user']);
        session_unset();
        session_destroy();
        header("Location: register.php");
        exit;
    }