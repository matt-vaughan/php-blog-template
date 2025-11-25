<?php
require_once './database.php';

$database = new Database();
$msgs = $database->get_messages();

foreach ($msgs as $msg) {
    $username = $msg['username'];
    $content  = $msg['content'];
    $date     = $msg['date_posted'];
    echo <<<EOF
    <li> 
    <span class="username"> $username </span> :
    <span class="message"> $content </span> 
    <span class="timestamp"> $date </span>
    </li>
    EOF;
}

?>