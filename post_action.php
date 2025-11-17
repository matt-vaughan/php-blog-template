<?php
require_once './database.php';

$result = "";
$imageUrl = "images/pic02.jpg"; // default image

// if the user uploaded an image file as a header image
if ($_FILES["image"] && $_FILES["image"]["name"] && $_FILES["image"]["name"] != "") {
    $target_dir = "/opt/bitnami/blogImgs/"; // Specify the directory where the image will be saved
    $target_file = $target_dir . basename($_FILES["image"]["name"]); // Get the file name from the uploaded file

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $result = "notAimage";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $result = "imgUploaded";
            $imageUrl = $target_file;
            //echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
        } else {
            $result = "imgUploadFailed";
            //echo "Sorry, there was an error uploading your file.";
        }
    }
}


$title = $_POST['title'];
$content = $_POST['content'];

$database = new Database();

$database->post($title, $content, $imageUrl);

header("Location: index.php");
exit(); // or die();
?>