<?php
require_once './database.php';

$limit = (int) $_POST['limit'];

function generate_message_list() {
	$database = new Database();
	$msgs = $database->get_messages($limit);
    $msgs = array_reverse($msgs); // put in ascending order

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
}
?>