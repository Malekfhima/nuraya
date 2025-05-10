<?php
include '../cnx.php';
$result_of_cards = mysqli_query($cnx , "SELECT * from products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Smartphone Product Card - Horizontal</title>
</head>
<body>
    <?php include '../adminsidebar.php'; ?>
    <form action="">
    <?php while($t = mysqli_fetch_assoc($result_of_cards)) : ?>
    <div class="product-card-horizontal">
        <div class="product-image">
            <!-- Replace with your actual image path -->
            <img src="<?php echo $t['image_url'] ; ?>" alt="">
        </div>
        
        <div class="product-details">
            <div class="product-title"><?php echo $t['name'] ; ?></div>
            
            <div class="product-description">
                <?php echo $t['description'] ; ?>
            </div>
            
            <div class="price-section">
                <span class="current-price"><?php echo $t['price'] ; ?></span>
            </div>
            
            <div class="action-buttons">
                <button type='submit' class="add-to-cart">delete</button>
                <button type='submit' class="quote-btn">edit</button><!--na3malhom bill <a> 5ir twali> -->
            </div>
        </div>
    </div>
    <br>
    <?php endwhile ; ?>
    </form>
</body>
</html>
