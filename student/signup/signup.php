<?php
    include "../../db/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Sign Up Page</title>
</head>
<body>
    <h1>Student Sign Up Page</h1>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Sign Up</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"] ?? '';
        $email = $_POST["email"] ?? '';
        $password = $_POST["password"] ?? '';

        $createStudent = "CREATE TABLE IF NOT EXISTS students (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )";

        if(mysqli_query($conn, $createStudent)) {
            if(empty($name) || empty($email) || empty($password)) {
                echo "All fields are required.";
                exit();
            }
            $check_email = "SELECT * FROM students WHERE email='$email'";
            if(mysqli_query($conn, $check_email)->num_rows > 0) {
                echo "Email already exists. Please use a different email.";
                exit();
            }
            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO students (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
            if (mysqli_query($conn, $insert_sql)) {
                // echo "New student registered successfully";
                header("Location: ../../student/login/login.php");
                exit();
            } else {
                echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Error creating table: " . mysqli_error($conn);
        }
        
    }
    ?>
</body>
</html>