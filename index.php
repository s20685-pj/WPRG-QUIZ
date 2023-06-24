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
    <!-- Page header -->
</header>
<main>
    <div class="container">
    <?php
    // Connecting to database
    require_once 'db_connection.php';
    global $connection;
    // Check if cookie Exists
    $cookie_name = "user";
    if(!isset($_COOKIE[$cookie_name])) {
    } else {
        // Getting value of cookie
        $cookieValue = $_COOKIE['user'];
        // Check if the user is already logged in
        $sql = "SELECT * FROM users WHERE login = '$cookieValue'";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $loged_in = $row['loged_in'];
            $isAdmin = $row['isAdmin'];

            // Sprawdzenie warunków
            if ($isAdmin == 1) {
                header('Location: admin_panel.php');
                exit;
            } elseif ($isAdmin == 0) {
                header('Location: user_panel.php');
                exit;
            }
        } else {
            echo "No user found";
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
        <label id="username-status" class="usernamestatusclass"></label><br>

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