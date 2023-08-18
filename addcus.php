<?php
session_start();
if(!(isset($_SESSION["user"])))
{
    header("location: index");
}

$user = $_SESSION["user"];

require_once("conn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="addcus.css">
</head>
<body>
<?php
echo "<div id='titlewrapper'>
        <h1>Account Manager</h1>
        <h4>$user</h4>
        </div>

        <form id='contentwrapper' action='add' method='post'>
        <input id='newamt' name='ncus' type='text' placeholder='Name of new customer' required>

        <button onclick='action(this.id)' name='addcus' class='profit action'><h3>Add</h3></button>
        </form> ";
?>
   
</body>
</html>