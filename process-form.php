<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "new_schema";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$date = isset($_POST['current-date']) ? $_POST['current-date'] : '';
$awareness = isset($_POST['awareness']) ? $_POST['awareness'] : '';
$understanding = isset($_POST['understanding']) ? $_POST['understanding'] : '';
$useful_area = isset($_POST['field']) ? implode(", ", $_POST['field']) : '';
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
// Map awareness values from form to database values
$awarenessMap = array('1' => 'yes', '2' => 'no', '3' => 'maybe');
$awareness = isset($awarenessMap[$awareness]) ? $awarenessMap[$awareness] : '';

// Prepare SQL statement to prevent SQL injection
$sql = "INSERT INTO Survey (date, awareness, understanding, useful_area, comment) VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters (s = string, i = integer)
$stmt->bind_param("ssiss", $date, $awareness, $understanding, $useful_area, $comment);

// Execute the statement
if ($stmt->execute()) {
    echo "Survey submitted successfully! Thank you for your response.";
    echo "<br><a href='form.html'>Submit another response</a>";
} else {
    echo "Error: " . $stmt->error;
}

// Close connections
$stmt->close();
$conn->close();

?>