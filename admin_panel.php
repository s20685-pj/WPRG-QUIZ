<?php
header('Location: Categorys.php');?>
exit;
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
    <div class="header-text">Logged as Administrator</div>
    <?php
    $cookie_name = "user";
    $cookieValue = $_COOKIE['user'];
    ?>
    <nav>
        <li>
            <a>Loged as <?php echo $cookieValue;?> </a>
        </li>
    </nav>
</header>
<div class="center-button" id="centerButton">
    <a href="Categorys.php" class="big-button" id="quiz-setting-button">Manage Quiz Categories and Questions</a>
</div>
<main>
    <?php

    ?>
</main>
<footer>
    <!-- Stopka strony -->
</footer>
<script>
    const categoryButtons = document.querySelectorAll('.category-button');
    const difficultyButtons = document.querySelectorAll('.difficulty-button');
    const modeButtons = document.querySelectorAll('.mode-button');

    // Add click event listeners to the category buttons
    categoryButtons.forEach(button => {
        button.addEventListener('click', () => {
            resetOptions(categoryButtons);
            toggleOption(button);
            checkStartButtonVisibility();
        });
    });

    // Add click event listeners to the difficulty buttons
    difficultyButtons.forEach(button => {
        button.addEventListener('click', () => {
            resetOptions(difficultyButtons);
            toggleOption(button);
            checkStartButtonVisibility();
        });
    });

    // Add click event listeners to the mode buttons
    modeButtons.forEach(button => {
        button.addEventListener('click', () => {
            resetOptions(modeButtons);
            toggleOption(button);
            checkStartButtonVisibility();
        });
    });

    // Function to reset the selected state of options
    function resetOptions(buttons) {
        buttons.forEach(button => {
            button.classList.remove('selected');
        });
    }

    // Function to toggle the selected state of an option
    function toggleOption(button) {
        button.classList.toggle('selected');
    }

    // Function to check the visibility of the start button
    function checkStartButtonVisibility() {
        const startButton = document.querySelector('.start-quiz-button');
        const selectedCategoryButtons = document.querySelectorAll('.category-button.selected');
        const selectedDifficultyButtons = document.querySelectorAll('.difficulty-button.selected');
        const selectedModeButtons = document.querySelectorAll('.mode-button.selected');

        // Show the start button if at least one option from each category is selected
        if (selectedCategoryButtons.length > 0 && selectedDifficultyButtons.length > 0 && selectedModeButtons.length > 0) {
            startButton.classList.remove('hidden');
        } else {
            startButton.classList.add('hidden');
        }
    }
</script>
</body>
</html>