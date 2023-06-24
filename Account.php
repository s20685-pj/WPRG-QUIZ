<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script>
        window.onload = function() {
            var settings = document.getElementById("quiz-settings-button");
            var settingss = document.getElementById("Settings");

            settings.onclick = function() {
                settingss.classList.remove("settings-none");
                settingss.classList.add("quiz-settings", "show");
            };
        };
    </script>
</head>
<body>
<header class="">
    <?php
    $cookie_name = "user";
    $cookieValue = $_COOKIE['user'];
    ?>
    <nav>
        <ul>
            <li>
                <a>Loged as <?php echo $cookieValue;?> </a>
            </li>
            <li>
                <a href="#">Quiz</a>
                <ul class="dropdown">
                    <li><a class="option" href="QUIZ_TIME.php">Start Quiz</a></li>
                    <li><a href="#">My Statistics</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Ranking</a>
                <ul class="dropdown">
                    <li><a href="#">Top 10</a></li>
                    <li><a href="#">Top 100</a></li>
                    <li><a href="#">Global Ranking</a></li>
                </ul>
            </li>
            <li>
                <a href="#">Settings</a>
                <ul class="dropdown">
                    <li><a href="Account.php">Account</a></li>
                    <li><a href="#">Privacy</a></li>
                </ul>
            </li>
            <li>
                <a href="logout.php">Log out</a>
            </li>
        </ul>
    </nav>
</header>
<main>
    <?php

    ?>
</main>
<footer>
    <!-- Stopka strony -->
</footer>
</body>
</html>