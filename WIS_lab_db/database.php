<?php

$servername = "localhost";
$username = "root";
$password = "";

// Connect to MySQL server
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get database name from user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["database_name"])) {

    $database_name = trim($_POST["database_name"]);

    if (empty($database_name)) {
        die("Database name is required.");
    }

    // Allow only letters, numbers and underscore
    if (!preg_match("/^[a-zA-Z0-9_]+$/", $database_name)) {
        die("Invalid database name.");
    }

    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS `$database_name`";

    if (!$conn->query($sql)) {
        die("Database creation failed: " . $conn->error);
    }

    // Select database
    $conn->select_db($database_name);

    // Create students table
    $sql = "CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(150) NOT NULL,
        age INT NOT NULL,
        course VARCHAR(100) NOT NULL
    )";

    if (!$conn->query($sql)) {
        die("Table creation failed: " . $conn->error);
    }
}
?>
