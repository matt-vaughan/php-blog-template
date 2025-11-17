<?php
require_once '/opt/bitnami/.secrets/blog-sql-password.php';

$servername = 'localhost'; 
$username = 'blogger'; // Your MySQL username
$password = BLOG_SQL_PASSWORD;
$dbname = 'blogtemplate'; // The name of your database

try {
    // Connect to the SQLite database
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions

    // Create a table
    $db->exec("DROP TABLE IF EXISTS posts ;");
    $db->exec("CREATE TABLE IF NOT EXISTS posts (id INTEGER AUTO_INCREMENT PRIMARY KEY, title TEXT, content TEXT, date_posted DATETIME DEFAULT CURRENT_TIMESTAMP)");

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>