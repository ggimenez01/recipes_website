<?php
// Include the database connection file
require_once 'connect.php';

// Sanitize the form data
$full_name = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$phone_number = filter_var($_POST['phone_number'], FILTER_SANITIZE_NUMBER_INT);
$cover_letter = filter_var($_POST['cover_letter'], FILTER_SANITIZE_STRING);

// Validate the form data
$errors = array();
if (empty($full_name)) {
  $errors['full_name'] = 'Full name is required';
}
if (empty($email)) {
  $errors['email'] = 'Email is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors['email'] = 'Email is invalid';
}
if (empty($phone_number)) {
  $errors['phone_number'] = 'Phone number is required';
} elseif (!preg_match("/^[0-9]{10}$/", $phone_number)) {
  $errors['phone_number'] = 'Phone number is invalid';
}

// If there are errors, display them and stop processing the form
if (!empty($errors)) {
  foreach ($errors as $error) {
    echo $error . '<br>';
  }
  exit;
}

// Prepare the SQL statement
$sql = "INSERT INTO job_applications (full_name, email, phone_number, resume_file_path, cover_letter) VALUES (:full_name, :email, :phone_number, :resume_file_path, :cover_letter)";
$stmt = $db->prepare($sql);

// Upload the resume file
if (isset($_FILES['resume'])) {
  $target_dir = "resume/";
  $target_file = $target_dir . basename($_FILES["resume"]["name"]);
  move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
  $resume_file_path = $target_file;
} else {
  $resume_file_path = "";
}

// Bind the parameters
$stmt->bindParam(':full_name', $full_name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':phone_number', $phone_number);
$stmt->bindParam(':resume_file_path', $resume_file_path);
$stmt->bindParam(':cover_letter', $cover_letter);

// Execute the statement
$stmt->execute();

// Redirect the user to the thank-you page
header("Location: thankyou.php");
exit;
?>