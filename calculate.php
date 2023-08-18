<?php
session_start();
if(!(isset($_SESSION["user"])))
{
    header("location: index");
}

$user = $_SESSION["user"];

require_once("conn.php");

$cid = $_GET['cid'];

$sql = "SELECT * FROM $user WHERE id = '$cid'";
$result = mysqli_fetch_assoc(mysqli_query($conn,$sql));
$camt = $result['amt'];

$newamt = $camt + $_GET['am'];

$sql = "UPDATE $user SET amt = $newamt WHERE id = $cid;";
$result = mysqli_query($conn,$sql);

header("location: home")

?>