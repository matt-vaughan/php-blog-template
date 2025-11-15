<?php

class Database {
    public function __construct() {
        
    }

    public function post($title, $content) {
        $db = null;
        try {
            $servername = "localhost";
            $username = "blogger"; // Your MySQL username
            $password = "24!BZ5q"; // Your MySQL password
            $dbname = "blogtemplate"; // The name of your database
            
            $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        // Insert data using prepared statements for security
        $stmt = $db->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);

        $title = 'Laptop';
        $content = 1200.00;
        $stmt->execute();
    }

    public function get_posts() {
        $db = null;
        try {
            $servername = "127.0.0.1";
            $username = "blogger"; // Your MySQL username
            $password = "24!BZ5q"; // Your MySQL password
            $dbname = "blogtemplate"; // The name of your database
            
            $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        // Select data
        $results = $db->query('SELECT * FROM posts');
        return $results;
    }

}


?>