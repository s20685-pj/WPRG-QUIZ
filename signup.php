<?php
require_once ('db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Validate and sanitize the input data (you can add more validation as needed)

    // Create a PDO connection to the MySQL database

    try {
        global $host, $db_name, $db_username, $db_password;
        $pdo = new PDO("mysql:host=$host;dbname=$db_name", $db_username, $db_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the username already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            // Redirect to the index page with an error message
            header("Location: indexerror.php");
            exit();
        }

        $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
        // Prepare and execute the INSERT query
        $stmt = $pdo->prepare("INSERT INTO users (login, email, password) VALUES (? ,? , ?)");
        $stmt->execute([$username, $email, $hashedpassword]);
        // Save username to session storage
        $_SESSION['username'] = $username;
        echo '<script> sessionStorage.setItem("username", "' .$_SESSION['username'] .'");</script>';
        echo 'Username saved!';
        // Create Cookie
        $cookie_name = 'user';
        $cookie_value = $username;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        // Redirect to the user panel
        header("Location: user_panel.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>