<?php
session_start();
require('connect.php');

if(isset($_POST['name'], $_POST['comment'], $_POST['recipe_id'], $_POST['captcha'])) {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $recipe_id = $_POST['recipe_id'];
    $user_captcha = $_POST['captcha'];

    if (empty($user_captcha) || $user_captcha != $_SESSION['captcha']) {
        // CAPTCHA validation failed
        $_SESSION['captcha_error'] = "Invalid CAPTCHA code";

        // Preserve the comment and name input values in session variables
        $_SESSION['comment_name'] = $name;
        $_SESSION['comment_message'] = $comment;

        // Redirect back to recipe_details.php
        header("Location: recipe_details.php?recipe_id=$recipe_id");
        exit();
    } else {
        // CAPTCHA validation passed
        // Remove the CAPTCHA code from the session
        unset($_SESSION['captcha']);

        // Get the comment message and user name (if provided) from the form
        $comment_message = $_POST['comment'];
        $comment_name = !empty($_POST['name']) ? $_POST['name'] : 'Anonymous';

        // Create the disemvoweled message
        $disemvoweled_message = str_replace(['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'], '', $comment_message);

        // Insert the comment into the database
        $query = "INSERT INTO comments (comment_message, comment_name, comment_timestamp, recipe_id, disemvoweled_message) VALUES (:comment_message, :comment_name, NOW(), :recipe_id, :disemvoweled_message)";
        $statement = $db->prepare($query);
        $statement->bindValue(':comment_message', $comment_message);
        $statement->bindValue(':comment_name', $comment_name);
        $statement->bindValue(':recipe_id', $recipe_id);
        $statement->bindValue(':disemvoweled_message', $disemvoweled_message);
        $statement->execute();

        // Clear the comment and name input values from session variables
        unset($_SESSION['comment_name']);
        unset($_SESSION['comment_message']);

        // Redirect back to the recipe details page
        header("Location: recipe_details.php?recipe_id=$recipe_id");
        exit();
    }
} else {
    // form not submitted or missing required fields
    $_SESSION['captcha_error'] = "Please fill out all required fields";

    // Preserve the comment and name input values in session variables
    $_SESSION['comment_name'] = $_POST['name'];
    $_SESSION['comment_message'] = $_POST['comment'];

    // Redirect back to recipe_details.php
    header("Location: recipe_details.php?recipe_id=$recipe_id");
    exit();
}
?>