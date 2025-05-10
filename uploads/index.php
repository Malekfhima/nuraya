<?php
include "../cnx.php";
$cat_res = mysqli_query($cnx,"SELECT * from categories");
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    extract($_POST);
    $img_name = $_FILES["pro_images"]["name"];
    $pro_images = "../uploads/uploaded/" . $img_name;
    move_uploaded_file($_FILES['pro_images']["tmp_name"],$pro_images);
    $d = date("Y-m-d h:i:sa");
    $result_of_ins = mysqli_query($cnx, "INSERT into products(name,description,price,stock_quantity,category_id,image_url,created_at,updated_at) values('$title','$description','$price','$quantity','$category','$pro_images','$d','$d');");  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Upload</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="main.js" defer></script>
</head>
<body>
    <?php include '../adminsidebar.php'; ?>

    <div class="form-container">
        
        <h2><i class="fas fa-plus-circle"></i> Create New Listing</h2>
        <form id="productForm" method="post"enctype="multipart/form-data">
            <div class="form-group">
                <label for="photos">
                    <i class="fas fa-images"></i> Photos
                    <span class="required">*</span>
                </label>
                <div class="photo-upload" id="photoUploadArea">
                    <i class="fas fa-camera"></i>
                    <p>Drag photos here or click to upload</p>
                    <p class="upload-hint">Supported formats: JPG, PNG, GIF (Max 5MB each)</p>
                    <input type="file" id="photos" name="pro_images" accept="image/*" multiple required style="display: none;">
                </div>
            </div>
            
            <div class="form-group">
                <label for="title">
                    <i class="fas fa-heading"></i> Title
                    <span class="required">*</span>
                </label>
                <input type="text" id="title" name="title" placeholder="What are you selling?" required>
                <div class="input-hint">Minimum 3 characters</div>
            </div>
            
            <div class="form-group">
                <label for="price">
                    <i class="fas fa-tag"></i> Price
                    <span class="required">*</span>
                </label>
                <div class="price-container">
                    <input type="number" id="price" name="price" placeholder="0.00" min="0" step="0.01" required>
                </div>
                <div class="input-hint">Enter a price greater than 0</div>
            </div>

            <div class="form-group">
                <label for="price">
                <i class='fas fa-box'></i> quantity
                    <span class="required">*</span>
                </label>
                <div class="quantity-container">
                    <input type="number" id="quantity" name="quantity" placeholder="0" min="0" step="0.01" required>
                </div>
                <div class="input-hint">Enter the stock quantity</div>
            </div>            
            <div class="form-group">
                <label for="category">
                    <i class="fas fa-tags"></i> Category
                    <span class="required">*</span>
                </label>
                <select name="category" id="category" required>
                    <option value="" disabled selected>Select a category</option>
                    <?php while($t = mysqli_fetch_assoc($cat_res)) : ?>
                        <option value="<?php echo $t['category_id']?>"><?php echo $t['name']?></option>
                    <?php endwhile ; ?>    
                </select>
                <div class="input-hint">Select a category for your product</div>
            </div>
            
            <div class="form-group">
                <label for="description">
                    <i class="fas fa-align-left"></i> Description
                    <span class="required">*</span>
                </label>
                <textarea id="description" name="description" placeholder="Include details like size, brand, color, condition, etc." required></textarea>
                <div class="input-hint">Minimum 10 characters</div>
            </div>

            <button type="submit" class="btn">
                <i class="fas fa-paper-plane"></i> Publish Listing
            </button>
        </form>
    </div>
</body>
</html>