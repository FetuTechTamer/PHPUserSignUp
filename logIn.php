<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>LOG IN</h1>
    <form action="login.php" method="POST">
        <label for="email">Email<br></label>
        <input type="email" name="login_email" id="email" placeholder="Enter Email" required><br>
        
        <label for="password">Password<br></label>
        <input type="password" name="login_password" id="password" placeholder="Enter Password" required><br>
        
        <input type="submit" name="submit" value="Log In"><br>
    </form>
    <div class="link-container">
        <a href="forget.php" style="padding-left: 420px;">Forget Your Password?</a>
        <a href="signUp.php">Sign Up!</a>
    </div>
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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_email = filter_var($_POST['login_email'], FILTER_SANITIZE_EMAIL);
    $login_password = $_POST['login_password'];

   
    $stmt = $conn->prepare("SELECT password FROM sign_up_table WHERE email = ?");
    $stmt->bind_param("s", $login_email);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($login_password, $row['password'])) {
            header("Location: success.html");
            exit;
        } else {
            echo "<p style='color:red;text-align: center;'>Incorrect password.</p>";
        }
    } else {
        echo "<p style='color:red;text-align: center;'>No user found with this email.</p>";
    }

    
    $stmt->close();
}

$conn->close();
?>