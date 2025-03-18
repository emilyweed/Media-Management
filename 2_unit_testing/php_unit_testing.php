<?php
use PHPUnit\Framework\TestCase;

class MediaLibraryTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        $this->conn = new mysqli("localhost", "root", "", "media_library");
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function testDatabaseConnection() {
        $this->assertNotNull($this->conn, "Database connection should not be null");
    }

    public function testAddMedia() {
        $title = "Test Book";
        $author = "John Doe";
        $type = "book";
        $cover_url = "https://via.placeholder.com/100x150";

        $stmt = $this->conn->prepare("INSERT INTO personal_media (title, author, type, cover_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $author, $type, $cover_url);
        $result = $stmt->execute();

        $this->assertTrue($result, "Media should be added successfully");
        $stmt->close();
    }

    public function testRetrieveMedia() {
        $sql = "SELECT * FROM personal_media ORDER BY date_added DESC LIMIT 1";
        $result = $this->conn->query($sql);

        $this->assertGreaterThan(0, $result->num_rows, "At least one media entry should exist");
    }

    protected function tearDown(): void {
        $this->conn->close();
    }
}