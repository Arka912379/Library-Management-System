<?php
    include "../../db/db.php";
    $username = "admin";
    $password = "admin123";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form> 
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputUsername = $_POST["username"] ?? '';
        $inputPassword = $_POST["password"] ?? '';

        if(empty($inputUsername) || empty($inputPassword)) {
            echo "All fields are required.";
            exit();
        }

        if ($inputUsername !== $username || $inputPassword !== $password) {
            echo "Not applicable";
            exit();
        }

        $createTable = "CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )";
        mysqli_query($conn, $createTable);

        $checkSql = "SELECT * FROM admins WHERE username='" . mysqli_real_escape_string($conn, $inputUsername) . "'";
        $result = mysqli_query($conn, $checkSql);
        
        if ($result->num_rows == 0) {
            $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);
            $insertSql = "INSERT INTO admins (username, password) VALUES ('" . mysqli_real_escape_string($conn, $inputUsername) . "', '$hashedPassword')";
            mysqli_query($conn, $insertSql);
        }

        header("Location: ../dashboard/dashboard.php");
        exit();
    }
    ?>
</body>
</html>