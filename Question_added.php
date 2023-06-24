<?php
require_once 'db_connection.php';
global $connection;

if(isset($_POST['action']))
{
    $questionId = $_POST['question_id'];

    // Wstawianie nowej kategorii do tabeli "categories"
    $sql = "DELETE FROM questions WHERE question_id = ".$questionId;

    if ($connection->query($sql) === TRUE) {
        // Przekierowanie do strony QUIZ_TIME.php
        header("Location: Categorys.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
} else {
    if (isset($_POST['category_id']) && isset($_POST['question']) && isset($_POST['difficulty_level']) && isset($_POST['answer_a']) && isset($_POST['answer_b']) && isset($_POST['answer_c']) && isset($_POST['answer_d']) && isset($_POST['correct_answers'])) {
        $categoryId = $_POST['category_id'];
        $question = $_POST['question'];
        $difficultyLevel = $_POST['difficulty_level'];
        $answerA = $_POST['answer_a'];
        $answerB = $_POST['answer_b'];
        $answerC = $_POST['answer_c'];
        $answerD = $_POST['answer_d'];
        $correctAnswer = $_POST['correct_answers'];

        $addQuestionQuery = $connection->prepare("INSERT INTO questions (category_id, question, difficulty_level, answer_a, answer_b, answer_c, answer_d, correct_answer) VALUES (:category_id, :question, :difficulty_level, :answer_a, :answer_b, :answer_c, :answer_d, :correct_answer)");
        $addQuestionQuery->bindParam(':category_id', $categoryId);
        $addQuestionQuery->bindParam(':question', $question);
        $addQuestionQuery->bindParam(':difficulty_level', $difficultyLevel);
        $addQuestionQuery->bindParam(':answer_a', $answerA);
        $addQuestionQuery->bindParam(':answer_b', $answerB);
        $addQuestionQuery->bindParam(':answer_c', $answerC);
        $addQuestionQuery->bindParam(':answer_d', $answerD);
        $addQuestionQuery->bindParam(':correct_answer', $correctAnswer);

        $addQuestionQuery->execute();

        // Powrót do strony z potwierdzeniem sukcesu
        header("Location: Categorys.php");
        exit();
    }
}
?>