<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>SIGN UP!</h1>
    <form action="" method="POST">
        <label for="username">Username<br></label>
        <input type="text" name="username" id="username" placeholder="JohnDoe" required><br>
        
        <label for="email">Email<br></label>
        <input type="email" name="email" id="email" placeholder="john@example.com" required><br>
        
        <label for="password">Password<br></label>
        <input type="password" name="password" id="password" placeholder="Enter Password" required><br>
        
        <input type="submit" name="submit" value="Register"><br><br>
        <a href="logIn.php" ><input type="button" name="login" value="Already Have an Account?"></a>
    </form>
</body>
</html>

<?php
$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "sign_up_db";

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);


if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo "<p>All fields are required.</p>";
        exit;
    }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

   
    $stmt = $conn->prepare("INSERT INTO sign_up_table (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

   
    if ($stmt->execute()) {
        echo "<p style='text-align: center;'>YOU ARE REGISTERED SUCCESSFULLY!</p>";
    } else {
        echo "<p style='text-align: center;'>UNABLE TO REGISTER. TRY AGAIN!</p>";
    }

    
    $stmt->close();
}

$conn->close();
?>