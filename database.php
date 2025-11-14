<?php

class Database {
    private $db;

    public function __construct() {
        try {
            // Connect to the SQLite database
            $db = new PDO('sqlite:./mydatabase.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function post($title, $content) {
        // Insert data using prepared statements for security
        $stmt = $db->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);

        $title = 'Laptop';
        $content = 1200.00;
        $stmt->execute();
    }

    public function get_posts() {
        // Select data
        $results = $db->query('SELECT * FROM posts');
        return $results;
    }

}


?>