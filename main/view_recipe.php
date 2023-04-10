<?php
require('connect.php');

// Get the recipe ID from the URL
$recipe_id = $_GET['recipe_id'];

// Retrieve the recipe details from the database
$query = "SELECT * FROM recipes WHERE recipe_id = :recipe_id";
$statement = $db->prepare($query);
$statement->execute(['recipe_id' => $recipe_id]);
$result = $statement->fetch();

// Display the recipe details
echo '<h1>' . $result['recipe_name'] . '</h1>';
echo '<img src="' . $result['recipe_image'] . '" alt="' . $result['recipe_name'] . '">';
echo '<p>' . $result['recipe_ingredients'] . '</p>';
echo '<p>' . $result['recipe_instructions'] . '</p>';
echo '<p>' . $result['recipe_sources'] . '</p>';
echo '<p>' . $result['recipe_categories'] . '</p>';
?>
