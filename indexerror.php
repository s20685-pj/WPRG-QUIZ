<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<header>
    <!-- Nagłówek strony -->
</header>
<main>
    <div class="container">
        <?php
        session_start();
        // Include your database connection configuration here
        require_once 'db_connection.php';
        // Check if the user is already logged in
        if (isset($_SESSION['username'])) {
            $loggedInUsername = $_SESSION['username'];
            $isAdmin = $_SESSION['isAdmin'];

            // Redirect the user based on their role
            if ($isAdmin) {
                // Code for admin panel
                header("Location: admin_panel.php");
                exit();
            } else {
                // Code for user panel
                header("Location: user_panel.php");
                exit();
            }
        }
        ?>

        <h2>Sign In</h2>
        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Log In">
        </form>

        <h2>Create an Account</h2>
        <form action="signup.php" method="POST" id="signup-form">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label id="username-status" class="usernamestatusclass">Username Taken</label><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="email">E-Mail:&nbsp&nbsp&nbsp&nbsp</label>
            <input type="email" id="email" name="email" required><br><br>

            <input type="submit" value="Sign Up">
        </form>
    </div>
</main>
<footer>
</footer>
</body>
</html>