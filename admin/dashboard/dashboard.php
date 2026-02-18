<?php
    include "../../db/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <div>
        <h2>upload books</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="bookName" placeholder="Book Name" required><br><br>
            <label for="book">Select book to upload:</label>
            <input type="file" id="book" name="book" accept=".jpg,.jpeg,.png" required><br><br>
            <select name="category" id="category">
                <option value="Fiction">Fiction</option>
                <option value="Non-Fiction">Non-Fiction</option>
                <option value="Science">Science</option>
                <option value="History">History</option>
            </select><br><br>
            <button type="submit">Upload Book</button>
        </form>
    </div>

</body>
</html>