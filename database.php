<?php

class Database {
    private $servername = 'localhost';
    private $username = 'blogger'; // Your MySQL username
    private $password = '24!BZ5q'; // Your MySQL password
    private $dbname = 'blogtemplate'; // The name of your database
    
    public function post($title, $content) {
        $db = null;
        try {
            $db = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
        } catch (PDOException $e) { 
            echo "Error: " . $e->getMessage();
        }
        // Insert data using prepared statements for security
        $stmt = $db->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->execute();
    }

    public function get_posts() {
        $db = null;
        try {
            $db = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        // Select data
        $results = $db->query("SELECT * FROM posts");
        return $results;
    }

}


?>