<?php
require_once './database.php';

$username = $_POST['username'];
$content  = $_POST['message'];

$database = new Database();
$database->message($username, $content);

header("Location: chat.php");
exit(); // or die();
?>