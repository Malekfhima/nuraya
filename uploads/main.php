<?php
include '../cnx.php';
extract($_POST);
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
            die ("<script>document.getElementById('errimg').innerHTML = 'File is too large.'</script>");
        } elseif (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            die ("<script>document.getElementById('errimg').innerHTML = 'Only JPG, JPEG, PNG, and GIF files are allowed.'</script>");
        } else {
            // Move file to uploads folder
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "<script>document.getElementById('errimg').innerHTML = 'the file $fileName has been uploaded'</script>";
            } else {

                die ("<script>document.getElementById('errimg').innerHTML = 'Error uploading your file.'</script>");
            }
        }
    } else {
        die ("<script>document.getElementById('errimg').innerHTML = 'File is not an image.'</die>(");
    }
    $result_of_ins = mysqli_query($cnx, "INSERT into product ('$targetFile','$title','$price','$category','$description');");  
}