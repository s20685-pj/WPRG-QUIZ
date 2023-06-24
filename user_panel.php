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
<div class="center-button" id="centerButton">
    <a href="#" class="big-button" id="quiz-settings-button">Set Settings</a>
</div>
<div class="settings-none" id="Settings">
    <div class="quiz-settings show">
        <h2>Quiz Settings</h2>
        <div class="settings-category">
            <h3>Category</h3>
            <div class="settings-category">
                <div class="category-buttons">
                    <?php
                    // Tworzenie połączenia z bazą danych
                    require_once 'db_connection.php';


                    // Wykonanie zapytania SQL
                    $sql = "SELECT category_id, name FROM categories";
                    global $connection;
                    $result = $connection->query($sql);

                    // Wyświetlanie wyników
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $categoryName = $row["name"];
                            $categoryId = $row["category_id"];
                            echo '<a class="category-button" value="' . $categoryId . '" onclick="toggleOption(this)">' . $categoryName . '</a>';
                        }
                    } else {
                        echo "Brak dostępnych kategorii.";
                    }

                    // Zamykanie połączenia z bazą danych
                    ?>
                </div>
            </div>
        </div>
        <div class="settings-difficulty">
            <h3>Difficulty Level</h3>
            <div class="difficulty-buttons">
                <?php
                require_once ('db_connection.php');
                global $connection;

                // Wykonanie zapytania SQL
                $sql = "SELECT diff_level_id, difficulty_level_name FROM difficulty_level";
                $result = $connection->query($sql);

                // Wyświetlanie wyników
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $difficultyLevelName = $row["difficulty_level_name"];
                        $diffLevelId = $row["diff_level_id"];
                        echo '<a class="difficulty-button" value="' . $diffLevelId . '" onclick="toggleOption(this)">' . $difficultyLevelName . '</a>';
                    }
                } else {
                    echo "Brak dostępnych poziomów trudności.";
                }

                // Zamykanie połączenia z bazą danych
                $connection->close();
                ?>
            </div>
        </div>
        <div class="settings-mode">
            <h3>Game Mode</h3>
            <div class="mode-buttons">
                <a class="mode-button" onclick="toggleOption(this)">1 player</a>
                <a class="mode-button" onclick="toggleOption(this)">1 vs 1</a>
            </div>
        </div>
        <div class="start-button">
            <a href="#" class="start-quiz-button hidden" id="startButton">Start your game!</a>
        </div>
    </div>
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
    // Get the "Start your game!" button
    const startButton = document.getElementById('startButton');

    // Add click event listener to the start button
    startButton.addEventListener('click', () => {
        // Get the selected difficulty level and category
        const selectedDifficultyButtons = document.querySelectorAll('.difficulty-button.selected');
        const selectedCategoryButtons = document.querySelectorAll('.category-button.selected');

        // Check if there is a selected difficulty level and category
        if (selectedDifficultyButtons.length > 0 && selectedCategoryButtons.length > 0) {
            // Get the difficulty level ID and category ID
            const difficultyLevelId = selectedDifficultyButtons[0].getAttribute('value');
            const categoryId = selectedCategoryButtons[0].getAttribute('value');

            // Save the difficulty level ID and category ID as cookies
            document.cookie = "Difficulty_Level=" + difficultyLevelId;
            document.cookie = "Category_id=" + categoryId;

            // Redirect to save_quiz_settings.php or another desired site
            window.location.href = "save_quiz_settings.php";
        }
    });
</script>
</body>
</html>