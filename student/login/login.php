<?php
    include "../../db/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login Page</title>
</head>
<body>
    <h1>Student Login Page</h1>
    <form method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"] ?? '';
        $password = $_POST["password"] ?? '';

        if(empty($email) || empty($password)) {
            echo "All fields are required.";
            exit();
        }

        $sql = "SELECT * FROM students WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<pre>";
            print_r($row);
            echo "</pre>";
            if (password_verify($password, $row["password"])) {
                // echo "Login successful!";
                header("Location: ../../home/index.php");
                exit();
            } else {
                echo "Invalid password. Please try again.";
            }
        } else {
            echo "No account found with that email. Please sign up.";
        }
    }
    ?>
</body>
</html>