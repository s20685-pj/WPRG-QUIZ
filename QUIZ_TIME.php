<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<header class="">
    <h2 class="header-text-2-0">QUIZ TIME!</h2>
</header>
<main>
    <?php
    // Check if the 'Difficulty_Level' cookie exists
    if (isset($_COOKIE['Difficulty_Level'])) {
        $difficultyLevel = $_COOKIE['Difficulty_Level'];
    } else {
        // Set a default difficulty level if the cookie doesn't exist
        $difficultyLevel = 'easy';
    }

    // Check if the 'Category_id' cookie exists
    if (isset($_COOKIE['Category_id'])) {
        $categoryId = $_COOKIE['Category_id'];
    } else {
        // Set a default category ID if the cookie doesn't exist
        $categoryId = 1;
    }

    // Database connection configuration
   require_once 'db_connection.php';
    global $connection;

    // Prepare the query to fetch a random question based on category and difficulty level
    $questionQuery = "SELECT question_id, question, used FROM questions WHERE category_id = $categoryId AND difficulty_level = '$difficultyLevel' ORDER BY RAND() LIMIT 1";
    $questionResult = mysqli_query($connection, $questionQuery);

    // Check if the question query was successful
    if ($questionResult && mysqli_num_rows($questionResult) > 0) {
        $questionRow = mysqli_fetch_assoc($questionResult);
        $questionId = $questionRow['question_id'];
        $question = $questionRow['question'];
        $questionused = $questionRow['used'];

        // Display the question inside the <div class="quiz_time_question">
        echo '<div class="quiz_time_question">' . $question . '</div>';

        // Query the database to fetch the answers for the selected question
        $answersQuery = "SELECT answer_a, answer_b, answer_c, answer_d FROM questions WHERE question_id = $questionId";
        $answersResult = mysqli_query($connection, $answersQuery);

        if ($answersResult && mysqli_num_rows($answersResult) > 0) {
            $answersRow = mysqli_fetch_assoc($answersResult);
            $answerA = $answersRow['answer_a'];
            $answerB = $answersRow['answer_b'];
            $answerC = $answersRow['answer_c'];
            $answerD = $answersRow['answer_d'];

            // Create a div container to display the answers
            echo '<div class="answers-container">';
            echo '<button class="quiz-time-answer-button" value="1">' . $answerA . '</button>';
            echo '<button class="quiz-time-answer-button" value="2">' . $answerB . '</button>';
            echo '<button class="quiz-time-answer-button" value="3">' . $answerC . '</button>';
            echo '<button class="quiz-time-answer-button" value="4">' . $answerD . '</button>';
            echo '</div>';
        } else {
            // Answers query failed or no answers found, handle the error
            echo 'Failed to fetch answers from the database.';
        }
    } else {
        // Question query failed or no question found, handle the error
        echo 'Failed to fetch a random question from the database.';
    }

    // Close the database connection
    mysqli_close($connection);
    ?>
</main>
<footer>
</footer>
<script>
    // Get all answer buttons
    const answerButtons = document.querySelectorAll('.quiz-time-answer-button');

    // Add event listener to each answer button
    answerButtons.forEach(answerButton => {
        answerButton.addEventListener('click', () => {
            // Remove 'selected' class from all answer buttons
            answerButtons.forEach(button => button.classList.remove('selected'));

            // Add 'selected' class to the clicked answer button
            answerButton.classList.add('selected');

            // Refresh page
            location.reload();
        });
    });
</script>
</body>
</html>