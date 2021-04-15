<?php session_start();

if (isset($_SESSION['valid'])) {
    header('Location: ./dashboard.php');
} else {
    header('Location: ./login.php');
}
