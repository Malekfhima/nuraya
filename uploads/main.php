<?php
include '../cnx.php';
extract($_POST);
$message = "";
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "uploaded/";
    $fileName = basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Limit file size (e.g., 5MB)
        if ($_FILES["image"]["size"] > 5 * 1024 * 1024) {
            $message = "❌ File is too large.";
        } elseif (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            $message = "❌ Only JPG, JPEG, PNG, and GIF files are allowed.";
        } else {
            // Move file to uploads folder
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $message = "✅ The file " . htmlspecialchars($fileName) . " has been uploaded.";
            } else {
                $message = "❌ Error uploading your file.";
            }
        }
    } else {
        $message = "❌ File is not an image.";
    }
}