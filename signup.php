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
    $newUsername = $_POST["newUsername"];
    $newPassword = $_POST["newPassword"];


    $newUsername = mysqli_real_escape_string($conn, $newUsername);
    $newPassword = mysqli_real_escape_string($conn, $newPassword);


    $hashedPassword = hash("sha256", $newPassword);

    $checkUserSql = "SELECT * FROM users WHERE username = '$newUsername'";
    $result = $conn->query($checkUserSql);
    $pattern = '/^[a-zA-Z][a-zA-Z0-9_]{0,63}$/';

    if(!preg_match($pattern, $newUsername)){
        echo '<script>alert("Do not use special characters in the username."); window.location.href = "signuppage";</script>';
    }
    else if ($result->num_rows > 0) {
        echo '<script>alert("User already exists."); window.location.href = "signuppage";</script>';
    } else {
        $insertUserSql = "INSERT INTO users (username, password) VALUES ('$newUsername', '$hashedPassword')";
        if ($conn->query($insertUserSql) === TRUE) {
            echo '<script>alert("Signup successful."); window.location.href = "index";</script>';
        } else {
            echo "Error: " . $insertUserSql . "<br>" . $conn->error;
        }
    }
}

?>
