<?php

session_start();
if(!(isset($_SESSION["user"])))
{
    header("location: index");
}


$username = $_SESSION["user"];
setcookie("accuser",$username,time() - 30);
unset($_SESSION['user']);
echo '<script>window.location.href = "index";</script>';

die();