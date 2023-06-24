<?php
// Retrieve the difficulty level and category ID from cookies
if (isset($_COOKIE['Difficulty_Level']) && isset($_COOKIE['Category_id'])) {
    $difficultyLevelId = $_COOKIE['Difficulty_Level'];
    $categoryId = $_COOKIE['Category_id'];

    // Additional logic or processing can be performed here

    // Redirect to another site or page
    header("Location: QUIZ_TIME.php");
    exit();
} else {
    // Cookies are not set, handle the error or redirect to an error page
    header("Location: QUIZ_TIME.php");
    exit();
}
?>