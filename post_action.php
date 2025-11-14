<?php
require_once './database.php';

$title = $_POST['title'];
$content = $_POST['content'];

$database = new Database();

$database->post($title, $content);

header("Location: index.php");
exit(); // or die();
?>