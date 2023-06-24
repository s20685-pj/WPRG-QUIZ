<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Category_Name'])) {
        $categoryName = $_POST['Category_Name'];
        $adminName = $_SERVER['REMOTE_USER'];

        // Połączenie z bazą danych
        require_once 'db_connection.php';
        global $connection;

        if(isset($_POST['action']))
        {
            // Wstawianie nowej kategorii do tabeli "categories"
            $sql = "DELETE FROM categories WHERE name = '$categoryName';";

            if ($connection->query($sql) === TRUE) {
                // Przekierowanie do strony QUIZ_TIME.php
                header("Location: Categorys.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        } else {
            // Wstawianie nowej kategorii do tabeli "categories"
            $sql = "INSERT INTO categories (name, admin_managed) VALUES ('$categoryName', '$adminName')";

            if ($connection->query($sql) === TRUE) {
                // Przekierowanie do strony QUIZ_TIME.php
                header("Location: Categorys.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $connection->error;
            }
        }


        $connection->close();
    }
}
?>