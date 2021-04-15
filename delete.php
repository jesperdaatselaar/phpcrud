<?php session_start();

require_once("connection.php");
if (!isset($_SESSION['valid'])) {
    header('Location: ./login.php');
}

$id = $_SESSION['id'];      
$result = mysqli_query($mysqli, "DELETE FROM login WHERE id = '$id'")
    or die("Could not execute the insert query." . mysqli_error($mysqli));
header('location: ./logout.php');
