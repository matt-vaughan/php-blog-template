<?php
require_once '/opt/bitnami/.secrets/blog-sql-password.php';

class Database {
    private $servername = 'localhost';
    private $username = 'blogger'; // Your MySQL username
    private $password = BLOG_SQL_PASSWORD;
    private $dbname = 'blogtemplate'; // The name of your database
    
    public function post($title, $content, $imageUrl) {
        $db = null;
        try {
            $db = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
        } catch (PDOException $e) { 
            echo "Error: " . $e->getMessage();
        }
        // Insert data using prepared statements for security
        $stmt = $db->prepare("INSERT INTO posts (title, content, image_url) VALUES (:title, :content, :image_url)");
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image_url', $imageUrl);
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

    public function message($username, $content) {
        $db = null;
        try {
            $db = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
        } catch (PDOException $e) { 
            echo "Error: " . $e->getMessage();
        }
        // Insert data using prepared statements for security
        $stmt = $db->prepare("INSERT INTO messages (username, content) VALUES (:username, :content)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':content', $content);
        $stmt->execute();
    }
    
    public function get_messages($limit=null) {
        $db = null;
        try {
            $db = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
        $results = null;
        if ( $limit != null ) {
            $results = $db->query("SELECT * FROM messages ORDER BY date_posted DESC LIMIT " . $limit);
        } else {
            $results = $db->query("SELECT * FROM (SELECT * FROM messages ORDER BY date_posted DESC) AS subquery_alias ORDER BY date_posted ASC");
        }
        
        return $results;
    }

}


?>