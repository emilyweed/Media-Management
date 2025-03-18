include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $type = $_POST['type'];
    $author_director = $_POST['author_director'];
    $year = $_POST['year'];

    $sql = "INSERT INTO media (title, type, author_director, year) 
            VALUES ('$title', '$type', '$author_director', '$year')";

    if ($conn->query($sql) === TRUE) {
        echo "New media added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Media</title>
</head>
<body>
    <h2>Add a New Media Item</h2>
    <form method="post">
        Title: <input type="text" name="title" required><br>
        Type: 
        <select name="type">
            <option value="Book">Book</option>
            <option value="Movie">Movie</option>
            <option value="Music">Music</option>
            <option value="Game">Game</option>
        </select><br>
        Author/Director: <input type="text" name="author_director"><br>
        Year: <input type="number" name="year"><br>
        <button type="submit">Add Media</button>
    </form>
</body>
</html>
