<?php

include ("connect.php");
$sql = "SELECT r.recipe_name, r.recipe_image, r.recipe_sources, c.recipe_categories 
FROM recipes r 
INNER JOIN categories c 
ON r.categories_id = c.categories_id 
ORDER BY RAND() LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute();
$recipe = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php
$sql = "SELECT r.restaurant_name, r.restaurant_address, r.restaurant_website, c.cuisine_type 
        FROM restaurant r 
        INNER JOIN cuisine c 
        ON r.cuisine_id = c.cuisine_id 
        ORDER BY RAND() LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute();

$restaurant = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php
$sql = "SELECT grocery_name, grocery_address, grocery_website
        FROM grocery 
        ORDER BY RAND() LIMIT 1";
$stmt = $db->prepare($sql);
$stmt->execute();

$grocery = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody Ref-Homepage</title>
    <link rel="stylesheet" href="index.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" />
    <div class="toptitle">
        <img id="logo" src="images/logo.png" alt="top">
        <div class="topnav">     
            <nav>
                    <a href="index.php">Home</a>  .   <a href="recipe.php">Recipe</a>  .  <a href="restaurant.php">Restaurant List</a> . <a href="grocery.php">Grocery List</a> . <a href="events.php">Food Events</a>  . <a href="../admin/login.php">Login</a>
            </nav>        
        </div>
</head>
<body>
  <div class="slideshow-container">
    <?php

    // Path to the uploads folder
    $uploads_folder = 'uploads/';

    // Fetch all image file names from the uploads folder
    $images = glob($uploads_folder . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
    ?>

    <!-- Slideshow -->
    <div class="slideshow">
        <?php foreach ($images as $image) : ?>
            <img src="<?php echo $image; ?>" alt="">
        <?php endforeach; ?>
    </div>
  </div>
  <div style="width: 65%; margin: 0 auto; background-color: #FFFF00;">
  <?php
  
$today = date('Y-m-d');
$query = "SELECT * FROM events WHERE event_date >= '$today' ORDER BY event_date LIMIT 1";
$stmt = $db->query($query);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if ($event) {
    $event_date = date('F j, Y', strtotime($event['event_date']));
    $event_name = $event['event_name'];
    $event_description = $event['event_description'];
    ?>
    <marquee>
        The next event is <?php echo $event_name; ?> on <?php echo $event_date; ?>. <?php echo $event_description; ?>
    </marquee>
    <?php
} else {
    echo "There are no upcoming events.";
}
?>
</div>
  <div class="box">
      <div class="title" onclick="alert('Welcome to my website!')">
<h1> Foody Ref</h1>
<p><b>Business Background</b></p>
<p>Foody Ref is a new created site that will help individuals regarding food issues and make it convenient for them to use. </p>
<p>This will be a one stop food shop for everybody.</p>
<p><b>How We Started</b></p>
<p>Many people are having a hard time choosing what food to eat. <p>
    There are so many list that can be search online but unable to find what we are craving, and which food will suit our tastebuds.</p>
    <p> Some people also consider healthy foods which concerned their health issues.</p>
    <p> Sites only show limited list of restaurants and food to choose that gives the user more time to search for what they wanted.</p>

        </div>
  
        </div>
        </div>


  <div class="featured">
  <div class="featured-restaurant">
    <div class="featured-box">
      <h2>Featured Restaurant</h2>
      <?php if (!empty($restaurant)) : ?>
        <div class="featured-restaurant-details">
          <h3>Restaurant Name:<?php echo $restaurant['restaurant_name']; ?></h3>
          <p>Address: <?php echo $restaurant['restaurant_address']; ?></p>
          <p>Cuisine Type: <?php echo $restaurant['cuisine_type']; ?></p>
          <p>Sources:<a href="<?php echo $restaurant['restaurant_website']; ?>" class="button">View full details</a></p>
        </div>
      <?php else : ?>
        <p>No restaurant found.</p>
      <?php endif; ?>
    </div>
  </div>
  <div class="featured_recipe">
    <div class="featured-box">
      <h2>Featured Recipe</h2>
      <?php
        // Fetch the image URL from the database
        $image_url = $recipe['recipe_image'];
      ?>

      <?php if (!empty($image_url)): ?>
        <img src="<?= $image_url ?>" alt="Recipe Image" class="img-fluid">
      <?php endif; ?>

      <?php if (!empty($recipe)) : ?>
        <div class="featured-recipe-details">
          <h3>Recipe Name:<?php echo $recipe['recipe_name']; ?></h3>
          <p>Categories: <?php echo $recipe['recipe_categories']; ?></p>
          <p>Sources:<a href="<?php echo $recipe['recipe_sources']; ?>" class="button">View full recipe</a></p>
        </div>
      <?php else : ?>
        <p>No recipes found.</p>
      <?php endif; ?>
    </div>
  </div>
  
 
  <div class="featured-grocery">
    <div class="featured-box">
      <h2>Featured Grocery</h2>
      <?php if (!empty($grocery)) : ?>
        <div class="featured-grocery-details">
          <h3>Grocery Name:<?php echo $grocery['grocery_name']; ?></h3>
          <p>Address: <?php echo $grocery['grocery_address']; ?></p>
          <p>Sources:<a href="<?php echo $grocery['grocery_website']; ?>" class="button">View full details</a></p>
        </div>
      <?php else : ?>
        <p>No grocery found.</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<footer>
<div class="bottomnav">     
            <nav>
                    <a href="index.php">Home</a>  .   <a href="career.php">Career</a> . <a href="contacts.php">Contact Us</a>
            </nav>        
        </div>
        <div class="bottom">My All Rights Reserve</div>
</footer>
      </body>
      </html>

<script>
  const slideshow = document.querySelector('.slideshow');
  const images = slideshow.querySelectorAll('img');
  let currentIndex = 0;

  setInterval(() => {
      images[currentIndex].style.opacity = 0;
      currentIndex = (currentIndex + 1) % images.length;
      images[currentIndex].style.opacity = 1;
  }, 3000);
</script>
