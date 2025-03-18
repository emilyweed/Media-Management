<?php
if (isset($_GET['query'])) {
    $search = urlencode($_GET['query']);
    $url = "https://openlibrary.org/search.json?q=$search";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if ($data['numFound'] > 0) {
        echo "<h2>Search Results:</h2>";
        foreach ($data['docs'] as $book) {
            $title = $book['title'] ?? "Unknown Title";
            $author = $book['author_name'][0] ?? "Unknown Author";
            $coverID = $book['cover_i'] ?? null;
            $coverURL = $coverID ? "https://covers.openlibrary.org/b/id/$coverID-M.jpg" : "https://via.placeholder.com/100x150";

            echo "<div style='border:1px solid #ddd; padding:10px; margin:10px;'>
                    <img src='$coverURL' alt='$title' width='100'><br>
                    <strong>$title</strong><br>
                    <small>by $author</small>
                  </div>";
        }
    } else {
        echo "<p>No results found.</p>";
    }
} else {
    echo "<p>Please enter a search term.</p>";
}
?>
