<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script>
        window.onload = function() {
            var addCategoryButton = document.getElementById("add-category-button");
            var categoryInputWrapper = document.getElementById("categoryInputWrapper");
            var categoryInput = document.getElementById("category-input");
            var addQuestionButton = document.getElementById("add-question-button");
            var addQuestionForm = document.getElementById("add-question-form");

            addCategoryButton.onclick = function() {
                categoryInputWrapper.classList.remove("hidden");
                categoryInput.focus();
            };

            addQuestionButton.onclick = function() {
                addQuestionForm.classList.remove("hidden");
            };
        };
    </script>
</head>
<body>
<header class="">
    <div class="header-text">Logged as Administrator</div>
    <a class="header-text-2-0">Modifying Categories and Questions</a>
</header>
<div class="center-button" id="centerButton">
    <a href="#" class="big-button" id="add-category-button">Add and Delete Category</a>
    <a href="#" class="big-button" id="add-question-button">Add and Delete Question</a>
</div>
<div class="center-button hidden" id="categoryInputWrapper">
    <!--Delete Category-->
    <form action="Questions.php" method="POST">
        <input name="action" type="text" class="hidden" value="delete">
        <label for="category-input" class="category-label">Category Name:</label>
        <input type="text" id="category-input" name="Category_Name" required><br><br>
        <button type="submit" value="Delete" class="add-button" id="add-button">Delete</button>
    </form>

    <!--Adding Category-->
    <form action="Questions.php" method="POST">
        <label for="category-input" class="category-label">Category Name:</label>
        <input type="text" id="category-input" name="Category_Name" required><br><br>
        <button type="submit" class="add-button" id="add-button">Add</button>
    </form>
</div>
<main>
    <div class="container hidden" id="add-question-form">
        <form action="Question_added.php" method="POST">
            <div class="form-group">
                <label for="category-select">Category:</label>
                <select id="category-select" name="category_id" required>
                    <?php
                    require_once 'db_connection.php';
                    global $connection;
                    // Selecting colums
                        $categoriesQuery = $connection->query("SELECT category_id, name FROM categories");
                        while ($row = $categoriesQuery->fetch_assoc()) {
                            $categoryId = $row['category_id'];
                            $categoryName = $row['name'];
                            echo "<option value=\"$categoryId\">$categoryName</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="question-input">Question:</label>
                <textarea id="question-input" name="question" rows="4" maxlength="125" required></textarea>
            </div>
            <div class="form-group">
                <label for="correct-answers-select">Difficulty Level</label>
                <select id="correct-answers-select" name="difficulty_level" required>
                    <option value="1">Easy</option>
                    <option value="2">Normal</option>
                    <option value="3">Hard</option>
                    <option value="4">Nightmare</option>
                </select>
            </div>
            <div class="form-group">
                <label for="answer-a-input">Answer A:</label>
                <input type="text" id="answer-a-input" name="answer_a" required>
            </div>
            <div class="form-group">
                <label for="answer-b-input">Answer B:</label>
                <input type="text" id="answer-b-input" name="answer_b" required>
            </div>
            <div class="form-group">
                <label for="answer-c-input">Answer C:</label>
                <input type="text" id="answer-c-input" name="answer_c" required>
            </div>
            <div class="form-group">
                <label for="answer-d-input">Answer D:</label>
                <input type="text" id="answer-d-input" name="answer_d" required>
            </div>
            <div class="form-group">
                <label for="correct-answers-select">Correct Answer(s):</label>
                <select id="correct-answers-select" name="correct_answers" required>
                    <option value="1">A</option>
                    <option value="2">B</option>
                    <option value="3">C</option>
                    <option value="4">D</option>
                </select>
            </div>
            <button type="submit" value="Add Question" class="big-button">Add</button>
        </form>

        <form action="Question_added.php" method="POST">
            <input type="text" name="action" value="delete" class="hidden">
            <div class="form-group">
                <label for="category-select">Question:</label>
                <select id="category-select" name="question_id" required>
                    <?php
                    // Selecting colums
                    $questionsQuery = $connection->query("SELECT question_id, question FROM questions");

                    while ($row = $questionsQuery->fetch_assoc()) {
                        $questionsId = $row['question_id'];
                        $questionsName = $row['question'];
                        echo "<option value=\"$questionsId\">$questionsName</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" value="Add Question" class="big-button">Delete</button>
        </form>
    </div>
</main>
<footer>
    <!-- Stopka strony -->
</footer>
</body>
</html>