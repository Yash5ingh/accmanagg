<?php
session_start();
if(!(isset($_SESSION["user"])))
{
    header("location: index");
}

$user = $_SESSION["user"];

require_once("conn.php");

$cid = $_GET['cid'];

$sql = "DELETE FROM $user WHERE id = $cid";
$result = mysqli_query($conn,$sql);

header("location:home")
?>