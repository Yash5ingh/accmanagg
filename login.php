<?php
require_once("conn.php");

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) !== TRUE) {
    echo "Error creating table: " . $conn->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $username = strtoupper($username);
    $hashedPassword = hash("sha256", $password);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        session_start();
        $_SESSION["user"] = $username;
        setcookie("accuser",$username,time() + (60 * 60 * 24 * 30));
        
        echo '<script>window.location.href = "home";</script>';
    } else {
        echo '<script>alert("Invalid username or Password."); window.location.href = "index";</script>';
    }
}

?>
