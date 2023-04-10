<?php
require('connect.php');

// Set default page and limit values
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 5;

// Get the search query and category ID from the URL parameters
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
$categories_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';
$selected_category_id = null;

if (isset($_GET['category_id'])) {
    $selected_category_id = $_GET['category_id'];
}

// Set searched flag
$searched = !empty($search_query) || !empty($categories_id);

// Modify the SQL query to filter by the search query and category ID
if ($searched) {
    $query = "SELECT COUNT(*) AS count FROM recipes WHERE 1 = 1";

    if (!empty($search_query)) {
        $query .= " AND recipe_name LIKE :search_query";
    }

    if (!empty($categories_id)) {
        $query .= " AND categories_id = :categories_id";

        // Check if the selected category is "Chicken"
        $category_query = "SELECT recipe_categories FROM categories WHERE categories_id = :categories_id";
        $category_statement = $db->prepare($category_query);
        $category_statement->bindValue(':categories_id', $categories_id);
        $category_statement->execute();
        $category = $category_statement->fetchColumn();

        if ($category === "Chicken" && !empty($search_query)) {
            $query .= " AND (recipe_ingredients LIKE :search_query OR recipe_instructions LIKE :search_query)";
        }
    }

    $statement = $db->prepare($query);

    if (!empty($search_query)) {
        $statement->bindValue(':search_query', '%' . $search_query . '%');
    }

    if (!empty($categories_id)) {
        $statement->bindValue(':categories_id', $categories_id);
    }

} else {
    $query = "SELECT COUNT(*) AS count FROM recipes";
    $statement = $db->prepare($query);
}

// Execute the query to get the total number of records
$statement->execute();
$row = $statement->fetch();
$total_records = $row['count'];
$total_pages = ceil($total_records / $limit);
$offset = ($page - 1) * $limit;

if ($searched) {
    $query = "SELECT * FROM recipes WHERE 1 = 1";

    if (!empty($search_query)) {
        $query .= " AND recipe_name LIKE :search_query";
    }

    if (!empty($categories_id)) {
        $query .= " AND categories_id = :categories_id";

        // Check if the selected category is "Chicken"
        $category_query = "SELECT recipe_categories FROM categories WHERE categories_id = :categories_id";
        $category_statement = $db->prepare($category_query);
        $category_statement->bindValue(':categories_id', $categories_id);
        $category_statement->execute();
        $category = $category_statement->fetchColumn();

        if ($category === "Chicken" && !empty($search_query)) {
            $query .= " AND (recipe_ingredients LIKE :search_query OR recipe_instructions LIKE :search_query)";
        }
    }

    $query .= " ORDER BY recipe_updated DESC, recipe_timestamp DESC LIMIT :limit OFFSET :offset";

    $statement = $db->prepare($query);
    $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
    $statement->bindValue(':offset', ($page - 1) * $limit, PDO::PARAM_INT);

    if (!empty($search_query)) {
        $statement->bindValue(':search_query', '%' . $search_query . '%');
    }

    if (!empty($categories_id)) {
        $statement->bindValue(':categories_id', $categories_id);
    }

} else {
    $query = "SELECT * FROM recipes ORDER BY recipe_updated DESC, recipe_timestamp DESC LIMIT :limit OFFSET :offset";
    $statement = $db->prepare($query);
    $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
    $statement->bindValue(':offset', ($page - 1) * $limit, PDO::PARAM_INT);
}

// Execute the query
$statement->execute();


// Check if no records found
if ($statement->rowCount() == 0) {
  if ($searched) {
    echo "No records found.";
  } else {
    echo "There are currently no recipes.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="recipe.css">
    <title>Welcome to Recipe Page!</title>
    <style>
      
    /*pagination*/
  .pagination ul {
    display: inline-block;
    list-style: none;
    margin: 0;
    padding: 0;
  }
  
  .pagination li {
    display: inline-block;
    margin: 0;
    padding: 0;
  }
  
  .pagination li.active a {
    font-weight: bold;
  }
  </style>
</head>
<body>
<div class="title">
    <img id="logo" src="images/logo.png" alt="top">
</div>
<div class="topnav">
  <nav>
    <a href="index.php">Back to Home</a> 
  </nav>
</div>

<div class="search">
  <form method="GET">
    <select name="category_id">
      <option value="">All Categories</option>
      <?php
        $categories_query = "SELECT * FROM categories";
        $categories_statement = $db->prepare($categories_query);
        $categories_statement->execute();
        while($categories_row = $categories_statement->fetch()): 
      ?>
        <option value="<?= $categories_row['categories_id'] ?>" <?= ($selected_category_id == $categories_row['categories_id']) ? 'selected' : '' ?>><?= $categories_row['recipe_categories'] ?></option>
      <?php endwhile ?>
    </select>
    <input type="text" name="search_query" value="<?= htmlentities($search_query) ?>" placeholder="Search...">
    <button type="submit">Search</button>
    <button type="button" onclick="window.location.href='recipe.php'">Clear</button>
  </form>
</div>
<div class="recipes">
        <h1>Recipes</h1>
        <div>
        <?php while($row = $statement->fetch()): ?>
            <h2><a href="recipe_details.php?recipe_id=<?= $row['recipe_id'] ?>"><?= $row['recipe_name'] ?></a></h2>


 
  <?php
    $categories_query = "SELECT * FROM categories WHERE categories_id = :categories_id";
    $categories_statement = $db->prepare($categories_query);
    $categories_statement->bindValue(':categories_id', $row['categories_id']);
    $categories_statement->execute();
    while($categories_row = $categories_statement->fetch()): 
  ?>
    <div>
      <h4>Categories:<?= $categories_row['recipe_categories'] ?></h4>
    </div>
  <?php endwhile ?>

  <?php
    // Fetch the image URL from the database
    $image_url = $row['recipe_image'];
  ?>

  <?php if (!empty($image_url)): ?>
    <img src="<?= $image_url ?>" alt="Recipe Image" class="img-fluid">
  <?php endif; ?>

  <h5>Sources:<?= $row['recipe_sources'] ?> </h5>
 
  <p> Date Created:<?= date("F d, Y, h:i a", strtotime($row['recipe_timestamp'])) ?></p>
  <p>Last Updated: <?= date("F d, Y, h:i a", strtotime($row['recipe_updated'])) ?></p>
  <hr>

  <h3>Comments:</h3>

  
  <div>
    <h4>Total Comments: <?php
        $recipe_id = $row['recipe_id'];
        $stmt = $db->prepare("SELECT COUNT(*) AS total_comments FROM comments WHERE recipe_id = :recipe_id");
        $stmt->bindValue(':recipe_id', $recipe_id, PDO::PARAM_INT);
        $stmt->execute();
        $row_count = $stmt->rowCount();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $row['total_comments'];
    ?></h4>
</div>
<hr>
<?php endwhile ?>
<div class="pagination">
  <?php if ($total_pages > 1): ?>
    <ul>
      <?php if ($page > 1): ?>
        <li><a href="?page=<?= $page - 1 ?>&search_query=<?= $search_query ?>&category_id=<?= $selected_category_id ?>">Previous</a></li>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <li <?= ($i == $page) ? 'class="active"' : '' ?>><a href="?page=<?= $i ?>&search_query=<?= $search_query ?>&category_id=<?= $selected_category_id ?>"><?= $i ?></a></li>
      <?php endfor; ?>

      <?php if ($page < $total_pages): ?>
        <li><a href="?page=<?= $page + 1 ?>&search_query=<?= $search_query ?>&category_id=<?= $selected_category_id ?>">Next</a></li>
      <?php endif; ?>
    </ul>
  <?php endif; ?>
</div>



</div>
</div>
<script>
    const searchInput = document.getElementById("search-input");
    const searchButton = document.getElementById("search-button");
    const clearButton = document.getElementById("clear-button");
    
    // Add event listener to search button
    searchButton.addEventListener("click", () => {
        const searchTerm = searchInput.value.trim();
        // Perform search
    });
    
    // Add event listener to clear button
    clearButton.addEventListener("click", () => {
        searchInput.value = "";
    });
</script>
<!-- Add jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Add JavaScript to listen for select change event and submit the form -->
<script>
$(function() {
  $('select[name="category_id"]').on('change', function() {
    $(this).closest('form').submit();
  });
});
</script>

</body>
</html>
