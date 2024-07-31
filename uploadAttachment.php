<?php

session_start();

// make a randomly generated string of 10 characters with letters and numbers

$randomString = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 10)), 0, 10);
$target_dir = "attachments/".$_SESSION['username']."/".$randomString."/";

// check if target directory does not exist

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$acceptableImageTypes = array("image/gif", "image/jpeg", "image/png", "image/webp", "image/svg");
$acceptableVideoTypes = array("video/mp4", "video/webm");

// check if the attachment is an image file
if (isset($_FILES["file"]) && in_array($_FILES["file"]["type"], $acceptableImageTypes)) {
$target_file = $target_dir . "image.png";
} else {
    if (isset($_FILES["file"]) && in_array($_FILES["file"]["type"], $acceptableVideoTypes)) {
        $target_file = $target_dir . "video.mp4";
    }
}
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["file"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    // if everything is ok, try to upload file
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo $target_file;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>