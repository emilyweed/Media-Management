<?php
require 'db.php';

// Function to check if the database connection is working
function testDatabaseConnection($conn) {
    if ($conn->connect_error) {
        return "Database Connection Failed: " . $conn->connect_error;
    }
    return "Database Connection Successful!";
}

// Function to test inserting a media record
function testInsertMedia($conn) {
    $title = "Test Book";
    $type = "Book";
    $author_director = "Test Author";
    $year = 2024;

    $sql = "INSERT INTO media (title, type, author_director, year) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $type, $author_director, $year);

    if ($stmt->execute()) {
        return "Insert Test Passed: Media record added successfully!";
    } else {
        return "Insert Test Failed: " . $stmt->error;
    }
}

// Function to test fetching media records
function testFetchMedia($conn) {
    $sql = "SELECT * FROM media";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return "Fetch Test Passed: Media records retrieved successfully!";
    } else {
        return "Fetch Test Failed: No records found.";
    }
}

// Run tests
echo testDatabaseConnection($conn) . "<br>";
echo testInsertMedia($conn) . "<br>";
echo testFetchMedia($conn) . "<br>";

// Cleanup: Remove the test record
$conn->query("DELETE FROM media WHERE title = 'Test Book'");

$conn->close();
?>