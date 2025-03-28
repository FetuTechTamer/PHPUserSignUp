# User Authentication PHP Application

## Overview

This PHP application provides a complete user authentication system featuring Sign Up, Login, and Forget Password functionalities. Users can register, log in with their credentials, and reset their passwords if they forget them.

## Features

- **User Sign Up**: New users can create an account with their email and password.
- **User Login**: Registered users can log in using their email and password.
- **Forget Password**: Users who forget their password can reset it securely.
- **Input validation**: Ensures all fields are properly validated before processing.

## Requirements

- PHP 7.0 or higher
- MySQL database
- A web server (like Apache or Nginx)
- Composer (optional, if using for dependency management)

## Installation

1. **Clone this repository**:
   ```bash
   git clone https://github.com/FetuTechTamer/ User_Authentication_PHP_Application.git
   cd User_Authentication_PHP_Application
Set up the database:
Create a MySQL database (e.g., user_auth_db).
Create a table named users with the following structure:

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
Configure database connection:
Open the PHP files (signup.php, login.php, forget.php) and update the database connection parameters as needed:

$db_server = "localhost"; // or your database host
$db_username = "root"; // your database username
$db_password = ""; // your database password
$db_name = "user_auth_db"; // your database name
Run the application:
Upload the files to your web server or run it locally using a tool like XAMPP or MAMP.
Access the application via your web browser:
Sign Up: http://localhost/your-repository/signup.php
Log In: http://localhost/your-repository/login.php
Forget Password: http://localhost/your-repository/forget.php

Usage

Sign Up
Navigate to the Sign Up page.
Enter your email address and password.
Submit the form to create a new account.

Log In
Navigate to the Login page.
Enter your registered email address and password.
Submit the form to log in.

Forget Password
Navigate to the Forget Password page.
Enter your registered email address.
Input your new password and confirm it.
Submit the form to reset your password.

Security Notes
Passwords are stored securely using hashing (with password_hash()).
Always validate and sanitize user inputs to prevent SQL injection and XSS attacks.
Implement HTTPS to secure data transmission.

Contributing:
Contributions are welcome! If you have suggestions for improvements, please submit a pull request or open an issue.
