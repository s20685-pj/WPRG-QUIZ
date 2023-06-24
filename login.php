<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userusername = $_POST['username'];
    $userpassword = $_POST['password'];

    // Connecting to database
    require_once 'db_connection.php';
    // Prepare the SQL statement to fetch the user from the database
    $query = "SELECT * FROM users WHERE login = '$userusername'";
    global $connection;
    $result = $connection->query($query);

    // Check if a row is returned
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($userpassword, $row['password'])) {
            // Set session variables
            $_SESSION['username'] = $row['login'];
            $_SESSION['isAdmin'] = $row['isAdmin'];


            // Redirect the user based on their role
            if ($row['isAdmin'] == 1) {
                $sql = "UPDATE users SET loged_in = '1' WHERE login = '$userusername'";
                if ($connection->query($sql) === TRUE) {
                    echo "Column Updated ";
                    // Create Cookie
                    $cookie_name = 'user';
                    $cookie_value = $userusername;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                } else {
                    echo "Error updating Column" . $connection->error;
                }
                // Code for admin panel
                header("Location: admin_panel.php");
                exit();
            } else {
                $sql = "UPDATE users SET loged_in = '1' WHERE login = '$userusername'";
                if ($connection->query($sql) === TRUE) {
                    // Create Cookie
                    echo "Column Updated ";
                    $cookie_name = 'user';
                    $cookie_value = $userusername;
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                    header("Location: user_panel.php");
                } else {
                    echo "Error updating Column" . $connection->error;
                }
                // Code for user panel

                exit();
            }
        }
    }
}

// Redirect to login page if the credentials are invalid
header("Location: index.php");
exit();
?>