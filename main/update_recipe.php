<?php
require('connect.php');

// Initialize errors array
$errors = array();

// Set the maximum file size in bytes (10 MB)
$max_file_size = 10000000;

// Sanitize and validate the recipe information from the form
$recipe_id = filter_input(INPUT_POST, 'recipe_id', FILTER_SANITIZE_NUMBER_INT);
$recipe_name = filter_input(INPUT_POST, 'recipe_name', FILTER_SANITIZE_STRING);
$recipe_ingredients = filter_input(INPUT_POST, 'recipe_ingredients', FILTER_SANITIZE_STRING);
$recipe_instructions = filter_input(INPUT_POST, 'recipe_instructions', FILTER_SANITIZE_STRING);
$recipe_sources = filter_input(INPUT_POST, 'recipe_sources', FILTER_SANITIZE_STRING);
$recipe_categories = filter_input(INPUT_POST, 'recipe_categories', FILTER_SANITIZE_NUMBER_INT);

// Check if the delete checkbox is checked
if(isset($_POST['delete_image'])) {
    // Get the image path from the database
    $query = "SELECT recipe_image FROM recipes WHERE recipe_id = :recipe_id";
    $statement = $db->prepare($query);
    $statement->execute(['recipe_id' => $recipe_id]);
    $result = $statement->fetch();
    $image_path = $result['recipe_image'];

    // Delete the image file from the server
    unlink($image_path);

    // Remove the image path from the database
    $query = "UPDATE recipes SET recipe_image = NULL WHERE recipe_id = :recipe_id";
    $statement = $db->prepare($query);
    $statement->execute(['recipe_id' => $recipe_id]);
}

// Check if an image was uploaded
if(isset($_FILES['recipe_image']) && $_FILES['recipe_image']['error'] == 0) {
    $file_name = $_FILES['recipe_image']['name'];
    $file_size = $_FILES['recipe_image']['size'];
    $file_tmp = $_FILES['recipe_image']['tmp_name'];
    $file_type = $_FILES['recipe_image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['recipe_image']['name'])));
    $extensions = array("jpeg","jpg","png");
    if(in_array($file_ext,$extensions) === false) {
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
    if($file_size > 2097152) {
        $errors[]='File size must be excately 2 MB';
    }
    if(empty($errors) == true) {
        $newFileName = uniqid('', true) . "." . $file_ext;
        $uploadPath = 'uploads/' . $newFileName;
        move_uploaded_file($file_tmp, $uploadPath);



// Resize the image to a maximum size of 500x500 pixels
$image = null;
if ($file_ext == "jpg" || $file_ext == "jpeg") {
    $image = imagecreatefromjpeg($uploadPath);
} else if ($file_ext == "png") {
    $image = imagecreatefrompng($uploadPath);
}
if ($image) {
    $width = imagesx($image);
    $height = imagesy($image);
    $max_width = 500;
    $max_height = 500;
    if ($width > $max_width || $height > $max_height) {
        $new_width = $max_width;
        $new_height = $height / ($width / $max_width);
        if ($new_height > $max_height) {
            $new_width = $new_width / ($new_height / $max_height);
            $new_height = $max_height;
        }
        $tmp_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($tmp_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
        if ($file_ext == "jpg" || $file_ext == "jpeg") {
            imagejpeg($tmp_image, $uploadPath, 100);
        } else if ($file_ext == "png") {
            imagepng($tmp_image, $uploadPath, 9);
        }
        imagedestroy($tmp_image);
    }
}  
        // Update the image path in the database
        $query = "UPDATE recipes SET recipe_image = :recipe_image WHERE recipe_id = :recipe_id";
        $statement = $db->prepare($query);
        $statement->execute(['recipe_image' => $uploadPath, 'recipe_id' => $recipe_id]);
    }
}

// Redirect to the recipe page
header("Location: recipe2.php?recipe_id=$recipe_id");
exit();
?>
