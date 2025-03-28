<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password?</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
<h1>FORGET YOUR PASSWORD?</h1>
    <form action="forget.php" method="POST">
        <label for="email">Email<br></label>
        <input type="email" name="login_email" id="email" placeholder="Enter Email" required><br>
        
        <label for="password">New Password<br></label>
        <input type="password" name="login_password" id="password" placeholder="Enter New Password" required><br>
        
        <label for="confirm_password">Confirm New Password<br></label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm New Password" required><br>
        
        <input type="submit" name="submit" value="Reset"><br>
    </form>

<?php
$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "sign_up_db";

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL);
    $new_password = $_POST['login_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "<p style='color:red;'>Passwords do not match. Please try again.</p>";
    } else {
        $stmt = $conn->prepare("SELECT * FROM sign_up_table WHERE email = ?");
        $stmt->bind_param("s", $login_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $conn->prepare("UPDATE sign_up_table SET password = ? WHERE email = ?");
            $update_stmt->bind_param("ss", $hashed_password, $login_email);

            if ($update_stmt->execute()) {
                echo "<p style='color:green;text-align: center;'>Your password has been successfully reset!</p><br>";
                echo "<p style='color:green;text-align: center;'><a href='logIn.php'>Log In!</a></p>";
            } else {
                echo "<p style='color:red;text-align: center;'>Failed to update password. Please try again.</p>";
            }

            $update_stmt->close();
        } else {
            echo "<p style='color:red;text-align: center;'>No user found with this email address.</p>";
        }

        $stmt->close();
    }
}

$conn->close();
?>
</body>
</html>