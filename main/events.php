<?php
require 'connect.php';

// Querying the database table to fetch the required data
$query = "SELECT * FROM events";
$stmt = $db->query($query);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="events.css">
    <title>Food Events</title>
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
  background-image: url("images/foodevent_background.jpg");
  background-size: cover;
} 
  </style>
</head>
<body>

<table>
  <tr>
    <th>Events Name</th>
    <th>Address</th>
    <th>Description</th>
    <th>For More Details</th>
  </tr>
  <?php
  // Fetching data from the database
  // Displaying it in a table
  foreach ($results as $row) {
    echo "<tr>";
    echo "<td>" . $row['event_name'] . "</td>";
    echo "<td>" . $row['event_address'] . "</td>";
    echo "<td>" . $row['event_description'] . "</td>";
    $url = $row['event_website'];
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
