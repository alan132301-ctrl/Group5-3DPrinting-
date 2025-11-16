<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";

// Create connection (without specifying database yet)
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql_db = "CREATE DATABASE IF NOT EXISTS survey_db";
if ($conn->query($sql_db) === true) {
    echo "Database created successfully or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db("survey_db");

// Create table
$sql_table = "CREATE TABLE IF NOT EXISTS survey_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    current_date VARCHAR(100),
    awareness INT,
    understanding INT,
    fields VARCHAR(500),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql_table) === true) {
    echo "Table created successfully or already exists.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

$conn->close();
echo "Database setup complete! You can now use the survey form.";

?>