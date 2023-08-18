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
    <link rel="stylesheet" href="action.css">
</head>
<body>
<?php
$cid = $_GET['cid'];

$sql = "SELECT * FROM $user WHERE id = '$cid'";
$result = mysqli_fetch_assoc(mysqli_query($conn,$sql));
$cname = $result['customer'];
$camt = $result['amt'];

echo "<div id='titlewrapper'>
        <h1>Account Manager</h1>
        <h4>$user</h4>
        </div>

        <div id='contentwrapper'>

        <div class='customer'>
            <h3>$cname</h3>";
            if($camt < 0){
                echo "<button class='amt loss'><h3>₹".-1*$camt."</h3></button>";
            }
            else{
                echo "<button class='amt profit'><h3>₹".$camt."</h3></button>";
            }
            
        echo"</div>

        <input id='newamt' type='number' placeholder='0'>

        <button onclick='action(this.id)' id='1' class='profit action'><h3>You Got</h3></button>
        <button onclick='action(this.id)' id='2' class='loss action'><h3>You Gave</h3></button>
        <a href='remove?cid=$cid'><button class='loss action'><h3>REMOVE</h3></button></a>
        </div>
        <script>
        function action(id){
        const a = document.querySelector('#newamt').value;
        if(a < 1){
        alert('Enter appropreate value');
        exit();
        }
        if(id == 1){
            window.location.href = 'calculate?am='+a+'&cid=$cid';
            exit();
        }
        else{
            window.location.href = 'calculate?am='+-a+'&cid=$cid';
            exit();
        }
        
        }
        </script>";
?>
    
</body>
</html>