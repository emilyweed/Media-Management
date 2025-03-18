<?php
include 'db.php';

$sql = "SELECT * FROM media ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Media Library</title>
</head>
<body>
    <h2>Media Library</h2>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Type</th>
            <th>Author/Director</th>
            <th>Year</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['type']; ?></td>
                <td><?php echo $row['author_director']; ?></td>
                <td><?php echo $row['year']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
