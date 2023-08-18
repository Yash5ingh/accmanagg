<?php
session_start();
if(!(isset($_SESSION["user"])))
{
    header("location: index");
}

$user = $_SESSION["user"];

require_once("conn.php");

$ncus = $_POST['ncus'];

$sql = "INSERT INTO $user (customer, amt) VALUES ('$ncus', '0')";
$result = mysqli_query($conn,$sql);

header("location:home")
?>