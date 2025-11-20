<?php
require_once './database.php';

$result = "";
$imageUrl = "images/pic02.jpg"; // default image

// if the user uploaded an image file as a header image
if ( isset($_FILES["image"]["name"]) && $_FILES["image"]["name"] != "" ) {
    $target_dir = "/opt/bitnami/blogImgs/"; // Specify the directory where the image will be saved
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // Get the file name from the uploaded file

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $result = "imgUploaded";
                $imageUrl = $target_file;
                //echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            } else {
                $result = "imgUploadFailed";
                //echo "Sorry, there was an error uploading your file.";
            }
        } else {
            $result = "notAimage";
        }
    }
}

$title = $_POST['title'];
$content = $_POST['content'];

$database = new Database();
$database->post($title, $content, $imageUrl);

header("Location: index.php?result=" . $result);
exit(); // or die();
?>