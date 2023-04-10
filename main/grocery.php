<?php
require 'connect.php';

// Querying the database table to fetch the required data
$query = "SELECT * FROM grocery";
$stmt = $db->query($query);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="grocery.css">
    <title>Grocery List</title>
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
background-image: url("images/grocery_background.jpg");
background-size: cover;
} 
      </style>
</head>
<body>

<table>
  <tr>
   
    <th>Grocery Name</th>
    <th>Address</th>
    <th>Description</th>
    <th>Website</th>
   
  </tr>
  <?php
  // Fetching data from the database
  // Displaying it in a table
  foreach ($results as $row) {
    echo "<tr>";
  
    echo "<td>" . $row['grocery_name'] . "</td>";
    echo "<td>" . $row['grocery_address'] . "</td>";
    echo "<td>" . $row['grocery_description'] . "</td>";
    $url = $row['grocery_website'];
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
</body>
</html>
