<?php
try {
    $database_name = './mydatabase.db';
    // create database if it doesn't exist
    $db = new SQLite3($database_name); 
    $db->close();

    // Connect to the SQLite database
    $db = new PDO('sqlite:'.$database_name);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions

    // Create a table
    $db->exec('CREATE TABLE IF NOT EXISTS posts (id INTEGER PRIMARY KEY, title TEXT, content TEXT, date_posted DATETIME DEFAULT CURRENT_TIMESTAMP)');

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>