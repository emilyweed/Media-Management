<?php
include 'db.php';

// Check if a search query is provided
if (!isset($_GET['query'])) {
    die("No search query provided.");
}

$query = urlencode($_GET['query']);
$url = "https://openlibrary.org/search.json?q=$query";

// Fetch data from Open Library API
$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data['numFound'] > 0) {
    foreach ($data['docs'] as $book) {
        $title = $book['title'] ?? "Unknown Title";
        $author = isset($book['author_name'][0]) ? $book['author_name'][0] : "Unknown Author";
        $year = $book['first_publish_year'] ?? null;

        // Insert data into the database
        $sql = "INSERT INTO media (title, type, author_director, year) VALUES (?, 'Book', ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $title, $author, $year);
        
        if ($stmt->execute()) {
            echo "Added: $title by $author ($year) <br>";
        } else {
            echo "Error inserting: " . $stmt->error . "<br>";
        }
    }
} else {
    echo "No results found for the query.";
}

$conn->close();
?>