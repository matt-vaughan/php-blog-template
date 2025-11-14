<?php
try {
    // Connect to the SQLite database
    $db = new PDO('sqlite:mydatabase.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions

    // Create a table
    $db->exec('CREATE TABLE IF NOT EXISTS posts (id INTEGER PRIMARY KEY, title TEXT, content TEXT, date_posted DATETIME DEFAULT CURRENT_TIMESTAMP)');

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>