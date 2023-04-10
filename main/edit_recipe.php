<?php

require('connect.php');

$query = "SELECT * FROM categories";
$statement = $db->prepare($query);
$result = $statement->execute();
$categories = $statement->fetchAll();

$recipe_id = $_GET['recipe_id'];
$query = "SELECT * FROM recipes WHERE recipe_id = :recipe_id";
$statement = $db->prepare($query);
$statement->execute(['recipe_id' => $recipe_id]);
$post = $statement->fetch();

// Fetch image URL

$image_url = isset($post['recipe_image']) ? $post['recipe_image'] : '';

if (isset($_FILES['recipe_image']) && $_FILES['recipe_image']['error'] == 0) {
    // Handle image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["recipe_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["recipe_image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["recipe_image"]["size"] > 500000) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        move_uploaded_file($_FILES["recipe_image"]["tmp_name"], $target_file);
        $image_url = $target_file;
    }
}


$query = "SELECT recipe_categories FROM categories WHERE categories_id = :categories_id";
$statement = $db->prepare($query);
$statement->execute(['categories_id' => $post['categories_id']]);
$categories_id = $statement->fetch();

$query = "SELECT * FROM categories";
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Edit your Recipe</title>
    <style>
        body {
            margin:0;
            padding:0;
            font-family: sans-serif;
            background-image: url("images/edit_background.jpg");
            background-size: cover;
            border: 6px solid #333;
        }
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
</head>
<body>
    
    <div class="edit_form">
  <h2>Edit your recipe post here:</h2>
  <form method="post" action="../main/update_recipe.php" enctype="multipart/form-data">
    <div class="edit_user">
      <input type="hidden" name="recipe_id" value="<?= $post['recipe_id'] ?>">
    </div>
    <div class="edit_user">
      <label>Name:</label>
      <input type="text" name="recipe_name" id="recipe_name" value="<?= $post['recipe_name'] ?>"><br>
    </div>
    <div class="edit_user">
      <label>Ingredients:</label>
      <textarea name="recipe_ingredients" id="recipe_ingredients"><?= $post['recipe_ingredients'] ?></textarea><br>
    </div>
    <div class="edit_user">
      <label>Instructions:</label>
      <textarea name="recipe_instructions" id="recipe_instructions"><?= $post['recipe_instructions'] ?></textarea><br>
    </div>
    <div class="edit_user">
      <label>Categories:</label>
      <select name="recipe_categories" id="recipe_categories">
        <?php foreach ($categories as $category): ?>
          <?php if($category['categories_id'] == $post['categories_id']):?>
            <option value="<?= $category['categories_id'] ?>" selected ><?= $category['recipe_categories'] ?></option>
          <?php else:?>
            <option value="<?= $category['categories_id'] ?>" ><?= $category['recipe_categories'] ?></option>
          <?php endif?>
        <?php endforeach; ?>
      </select>
    </div>
    <br>
    <div class="edit_user">
      <label>Sources:</label>
      <input type="text" name="recipe_sources" id="recipe_sources" value="<?= $post['recipe_sources'] ?>"><br>
    </div>
    <br>
    <div class="edit_user">
      <label>Images:</label>
      <?php if (!empty($image_url)): ?>
        <img src="<?= $image_url ?>" alt="Recipe Image" class="img-fluid">
        <br>
        <label for="delete_image">Delete Image:</label>
        <input type="checkbox" id="delete_image" name="delete_image" value="1">
      <?php endif; ?>
      <br>
      <label for="recipe_image">Upload Image:</label>
      <input type="file" id="recipe_image" name="recipe_image">
    </div>
    <br>
    <input type="submit" value="Update">
    <button class="btn btn-danger"><a href="../admin/delete_recipe.php?recipe_id=<?= $post['recipe_id'] ?>">Delete</a></button>
  </form>
</div>



  </form>

</div>
</body>
</html>