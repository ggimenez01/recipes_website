<?php
require 'connect.php';

// Querying the database table to fetch the required data
if (isset($_GET['cuisine'])) {
  $cuisine = $_GET['cuisine'];
  if ($cuisine === 'All Cuisines') {
    $query = "SELECT restaurant_id, restaurant_name, restaurant_description, restaurant_address, restaurant_website FROM restaurant";
    $stmt = $db->query($query);
  } else {
    $query = "SELECT r.restaurant_id, r.restaurant_name, r.restaurant_description, r.restaurant_address, r.restaurant_website 
              FROM restaurant r 
              JOIN cuisine c ON r.cuisine_id = c.cuisine_id 
              WHERE c.cuisine_type = :cuisine";
    $stmt = $db->prepare($query);
    $stmt->execute([':cuisine' => $cuisine]);
  }
} else {
  $query = "SELECT restaurant_id, restaurant_name, restaurant_description, restaurant_address, restaurant_website FROM restaurant";
  $stmt = $db->query($query);
}

$cuisines = ["All Cuisines", "Chinese", "Italian", "Japanese", "Mexican", "Thai"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="restaurant.css">
    <title>Restaurant List</title>
    <div class="title">
    <img id="logo" src="images/logo.png" alt="top">
</div>
<div class="topnav">
  <nav>
    <a href="index.php">Back to Home</a> 
  </nav>
</div>
<style>
      body{
background-image: url("images/restaurant_background.jpg");
background-size: cover;
} 
      </style>
</head>
<body>

<div class="restaurant">
<form action="" method="get">
  <label for="cuisine">Choose a cuisine:</label>
  <select name="cuisine" id="cuisine">
    <?php foreach ($cuisines as $cuisine) {
      $selected = '';
      if (isset($_GET['cuisine']) && $_GET['cuisine'] == $cuisine) {
        $selected = 'selected';
      }
      echo "<option value='$cuisine' $selected>$cuisine</option>";
    } ?>
  </select>
  <button type="submit">Filter</button>
</form>
<table>
  <tr>
    <th>Name</th>
    <th>Description</th>
    <th>Address</th>
    <th>Website</th>
  </tr>
  <?php
  // Fetching data from the database
  // Displaying it in a table
  foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    echo "<tr>";
    echo "<td>" . $row['restaurant_name'] . "</td>";
    echo "<td>" . $row['restaurant_description'] . "</td>";
    echo "<td>" . $row['restaurant_address'] . "</td>";
    $url = $row['restaurant_website'];
    if (filter_var($url, FILTER_VALIDATE_URL)) {
      $url = filter_var($url, FILTER_SANITIZE_URL);
      echo "<td><a href='" . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . "</a></td>";
    } else {
      echo "<td></td>";
    }
    echo "</tr>";
  }
  ?>
</table>
</div>
</body>
</html>
