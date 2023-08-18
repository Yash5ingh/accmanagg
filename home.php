<?php
session_start();
if(!(isset($_SESSION["user"])))
{
    header("location: index");
}

$user = $_SESSION["user"];

require_once("conn.php");

$sql = "CREATE TABLE IF NOT EXISTS $user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer VARCHAR(20) NOT NULL,
    amt int NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div id="titlewrapper">
        <h1>Account Manager</h1>
        <h4><?php echo $user ?></h4>
        <a  id="logout" href="logout"><h4>Logout</h4></a>
    </div>

    <div id="contentwrapper">

        <div id="totalwrapper">
            
            <?php
            $got = 0;
            $gave = 0;

            $sql = "SELECT amt FROM $user";
            
            $result = mysqli_query($conn,$sql);
            $checksum = mysqli_num_rows($result);
            if($checksum > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $camt = $row['amt'];

                    if($camt < 0){
                        $gave += $camt;
                    }
                    else{
                        $got += $camt;
                    }
                }
            }
            echo "<div class='totals'>
                <h2>₹$got</h2>
            </div>
            <div class='totals'>
                <h2>₹".-1*$gave."</h2>
            </div>
            <div class='totals'>
                <h2>₹".($gave + $got)."</h2>
            </div>";
            ?>
            
        </div>

        <div id="addwrapper">
            <a href="addcus" id="add">
                <h2>Add Customer</h2>
                <h2>+</h2>
          </a>
        </div>

        <div id="list">

            <?php
            $sql = "SELECT * FROM $user ORDER BY amt";
            $result = mysqli_query($conn,$sql);
            $checksum = mysqli_num_rows($result);
            if($checksum > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $cid = $row['id'];
                    $cname = $row['customer'];
                    $camt = $row['amt'];

                    if($camt < 0){
                        echo "<div class='customer'>
                           <h3>$cname</h3>
                           <a href='action?cid=$cid'><button class='amt loss'><h3>₹".-1*$camt."</h3></button></a>
                        </div>";
                    }
                    else{
                        echo "<div class='customer'>
                           <h3>$cname</h3>
                           <a href='action?cid=$cid'><button class='amt profit'><h3>₹$camt</h3></button></a>
                        </div>";
                    }
                }
            }
            ?>

        </div>
    </div>


</body>
</html>