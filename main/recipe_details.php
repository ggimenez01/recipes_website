<?php
require('connect.php');
session_start();

// Retrieve the recipe ID from the URL parameter
$recipe_id = isset($_GET['recipe_id']) ? $_GET['recipe_id'] : '';

// Query the database for the recipe details
$query = "SELECT * FROM recipes WHERE recipe_id = :recipe_id";
$statement = $db->prepare($query);
$statement->bindValue(':recipe_id', $recipe_id);
$statement->execute();
$recipe = $statement->fetch(PDO::FETCH_ASSOC);

// Fetch the category details for the recipe
$category_query = "SELECT recipe_categories FROM categories WHERE categories_id = :categories_id";
$category_statement = $db->prepare($category_query);
$category_statement->bindValue(':categories_id', $recipe['categories_id']);
$category_statement->execute();
$category = $category_statement->fetch(PDO::FETCH_ASSOC);

// Query the database for the comments associated with the recipe
$comments_query = "SELECT * FROM comments WHERE recipe_id = :recipe_id";
$comments_statement = $db->prepare($comments_query);
$comments_statement->bindValue(':recipe_id', $recipe_id);
$comments_statement->execute();
$comments = $comments_statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recipe_details.css">
  <title><?= $recipe['recipe_name'] ?></title>
  <style>
  body{
        
        background-size:cover;
        background-image: url("images/recipe_details_background.jpg");
      }
      </style>
</head>
<body>
<div class="title">
    <img id="logo" src="images/logo.png" alt="top">
</div>
<div class="topnav">
  <nav>
    <a href="../main/recipe.php">Back to Recipe</a> 
  </nav>
</div>
<div class="recipes">
  <h1>Recipe Name: <?= $recipe['recipe_name'] ?></h1>
  <p> Ingredients: <?= $recipe['recipe_ingredients'] ?></p>
  <p>Instructions: <?= $recipe['recipe_instructions'] ?></p>
  <div>
    <h4>Category: <?= $category['recipe_categories'] ?></h4>
  </div>

  <?php
    // Fetch the image URL from the database
    $image_url = $recipe['recipe_image'];
  ?>

  <?php if (!empty($image_url)): ?>
    <img src="<?= $image_url ?>" alt="Recipe Image" class="img-fluid">
  <?php endif; ?>

  <h5>Source: <?= $recipe['recipe_sources'] ?> </h5>
 
  <p>Date Created: <?= date("F d, Y, h:i a", strtotime($recipe['recipe_timestamp'])) ?></p>
  <p>Last Updated: <?= date("F d, Y, h:i a", strtotime($recipe['recipe_updated'])) ?></p>

  <!-- Display the comments for the recipe -->
  <div>
    <h3>Comments:</h3>
    <?php foreach ($comments as $comment): ?>
      <div>
        <p><b>Name:</b><?= !empty($comment['comment_name']) ? $comment['comment_name'] : "Anonymous" ?></p>
      <p><b>Message:</b> <?= $comment['comment_message'] ?></p>
        <p><small>Posted on <?= date("F d, Y, h:i a", strtotime($comment['comment_timestamp'])) ?></small></p>
      </div>
    <?php endforeach; ?>
  </div>
  <div>Leave a Comment:</div>
  <form method="post" action="add_comment.php">
  <label for="name">Name:</label>
  <input type="text" name="name" id="name" value="<?php echo isset($_SESSION['comment_name']) ? htmlspecialchars($_SESSION['comment_name']) : ''; ?>">
<br>
<label for="comment">Comment:</label>
<textarea name="comment" id="comment" rows="5"><?php echo isset($_SESSION['comment_message']) ? htmlspecialchars($_SESSION['comment_message']) : ''; ?></textarea>
    <br>
  
  <div>
    <label for="captcha">Please enter the CAPTCHA code:</label>
    <img src="captcha.php" alt="CAPTCHA">


<input type="text" name="captcha" required>
<?php if (isset($_SESSION['captcha_error'])): ?>
    <p style="color: red;">Error: <?php echo $_SESSION['captcha_error']; ?></p>
    <?php unset($_SESSION['captcha_error']); ?>
<?php endif; ?>


  </div>
  <button type="submit">Submit</button>
    <input type="hidden" name="recipe_id" value="<?php echo htmlspecialchars($_GET['recipe_id']); ?>">
</form>
</div>


</body>
</html>
