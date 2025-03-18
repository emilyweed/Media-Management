<?php
// Database credentials
$host = "localhost";
$username = "root";  // Default XAMPP MySQL user
$password = "";      // Leave empty unless you set one
$dbname = "media_library";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>
