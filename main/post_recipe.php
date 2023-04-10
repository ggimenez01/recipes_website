<?php
require('connect.php');
require 'ImageResize.php';
require 'ImageResizeException.php';

$error = '';
$success = '';

$query = "SELECT * FROM categories";
$statement = $db->prepare($query);
$result = $statement->execute();
$categories = $statement->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['recipe_name']) || empty($_POST['recipe_ingredients']) || empty($_POST['recipe_instructions']) || empty($_POST['recipe_sources']) || empty($_POST['recipe_categories'])) {
        $error = 'All fields are required';
    } else {
        $recipe_name = filter_input(INPUT_POST, 'recipe_name', FILTER_SANITIZE_STRING);
        $recipe_ingredients = filter_input(INPUT_POST, 'recipe_ingredients', FILTER_SANITIZE_STRING);
        $recipe_instructions = filter_input(INPUT_POST, 'recipe_instructions', FILTER_SANITIZE_STRING);
        $categories_id = filter_input(INPUT_POST, 'recipe_categories', FILTER_SANITIZE_NUMBER_INT);
        $recipe_sources = filter_input(INPUT_POST, 'recipe_sources', FILTER_SANITIZE_STRING);

        // Insert recipe into database
        $query = "INSERT INTO recipes (recipe_name, recipe_ingredients, recipe_instructions, recipe_sources, recipe_image, categories_id) VALUES (:recipe_name, :recipe_ingredients, :recipe_instructions, :recipe_sources, :recipe_image, :categories_id)";
        $statement = $db->prepare($query);
        $statement->bindValue(':recipe_name', $recipe_name);
        $statement->bindValue(':recipe_ingredients', $recipe_ingredients);
        $statement->bindValue(':recipe_instructions', $recipe_instructions);
        $statement->bindValue(':recipe_sources', $recipe_sources);
        $statement->bindValue(':categories_id', $categories_id);

        // If an image is uploaded, save its path in the database
        if (!empty($_FILES['fileUpload']['name'])) {
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($_FILES["fileUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $allowedTypes = array("jpg", "jpeg", "png", "gif");

            // Check if uploaded file is an image
            if (in_array($imageFileType, $allowedTypes)) {
                // Upload the file
                if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $targetFile)) {
                   // Resize the image to max width 400px
$resizedFile = $targetDir . pathinfo($targetFile, PATHINFO_FILENAME) . '_medium.' . $imageFileType;
$image = new Gumlet\ImageResize($targetFile);
$image->resizeToWidth(400);
$image->save($resizedFile);

// Delete the original image file
unlink($targetFile);

// Save the resized image path in the database
$statement->bindValue(':recipe_image', $resizedFile);

                } else {
                    $error = 'There was an error uploading your file';
                }
            } else {
                $error = 'Only JPG, JPEG, PNG & GIF files are allowed';
            }
        } else {
            $statement->bindValue(':recipe_image', null, PDO::PARAM_NULL);
        }

        if (!$error && $statement->execute()) {
            $success = 'Recipe posted successfully';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
 
    <title>Post Your Recipes</title>
    </style>
    <div class="title">
        <img id="logo" src="images/logo.png" alt="top">
    </div>
    <div >
        <nav>
            <div class="topnav">
                <a href="../main/recipe2.php">Back to Recipe Page</a>
                
            </div>
        </nav>
    </div>
    <style>
        body {
            margin:0;
            padding:0;
            font-family: sans-serif;
            background-image: url("images/post_background.jpg");
            background-size: cover;
            border: 6px solid #333;
        }
    </style>
</head>

<body>
<div class="edit_form"> 
<h1>Post your Recipe!</h1>

<form method="post" enctype="multipart/form-data">

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>

    <div class="edit_user">
        <label for="recipe_name">Recipe Name:</label>
        <input type="text" id="recipe_name" name="recipe_name" placeholder="Recipe Name">
    </div>

    <div class="edit_user">
        <label for="recipe_ingredients">Ingredients:</label>
        <textarea id="recipe_ingredients" name="recipe_ingredients" placeholder="Recipe Ingredients"></textarea>
    </div>

    <div class="edit_user">
        <label for="recipe_instructions">Instructions:</label>
  <textarea id="recipe_instructions" name="recipe_instructions" placeholder="Recipe Instructions"></textarea>
</div>


<div class="edit_user">
  <label for="recipe_categories">Categories:</label>
  <select name="recipe_categories" id="recipe_categories">
    <option value="">Select a category</option>
  <?php foreach($categories as $category):?>  <option value="<?=$category['categories_id']?>"> <?= $category['recipe_categories']?> <?php endforeach ?>
  </select>
        </div>

    
        <div class="container mt-5">
    <form action="file-upload.php" method="post" enctype="multipart/form-data" class="mb-3">
      <h3 class="text-center mb-5">Upload File in PHP</h3>
      <div class="user-image mb-3 text-center">
        
          <img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder" alt="">
       
      </div>
      <div class="custom-file">
        <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile">
        <label class="custom-file-label" for="chooseFile">Select file</label>
      </div>
      
  
  </div>
<br>
<div class="edit_user">
            <label for="recipe_sources">Sources: </label>
          <textarea id="recipe_sources" name="recipe_sources" placeholder="Recipe Sources"></textarea>
        </div>
        <br>
        <br>
     <br>
     <input type="submit" name="Submit" value="Submit Your Recipe">
  </div>
     </form>  
</form>
     
    </body>
</html>
