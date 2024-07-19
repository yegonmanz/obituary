<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to the database
$servername = "localhost";
$username = "root"; // default XAMPP MySQL username
$password = ""; // default XAMPP MySQL password
$dbname = "obituary_platform";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture and sanitize form data
$name = htmlspecialchars($_POST['name']);
$date_of_birth = htmlspecialchars($_POST['date_of_birth']);
$date_of_death = htmlspecialchars($_POST['date_of_death']);
$content = htmlspecialchars($_POST['content']);
$author = htmlspecialchars($_POST['author']);

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO obituaries (name, date_of_birth, date_of_death, content, author) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $date_of_birth, $date_of_death, $content, $author);

// Execute the statement
if ($stmt->execute() === TRUE) {
    echo "Obituary submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
