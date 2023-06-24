<?php
session_start();
// Database connection configuration
$host = '5.39.83.70';
$db_name = 'benek_db';
$db_username = 'benek';
$db_password = 'superHaslo1$';

// Create a new MySQLi instance
$connection = new mysqli($host, $db_username, $db_password, $db_name);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
