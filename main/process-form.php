<?php
// Sanitize user input
function sanitize_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Validate user input
function validate_input($firstname, $lastname, $email, $message) {
  $errors = array();
  if (empty($firstname)) {
    $errors[] = 'First Name is required.';
  }
  if (empty($lastname)) {
    $errors[] = 'Last Name is required.';
  }
  if (empty($email)) {
    $errors[] = 'Email is required.';
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email format.';
  }
  if (empty($message)) {
    $errors[] = 'Message is required.';
  }
  return $errors;
}

// Connect to the database
require_once('connect.php');

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  $firstname = sanitize_input($_POST['firstname']);
  $lastname = sanitize_input($_POST['lastname']);
  $email = sanitize_input($_POST['email']);
  $message = sanitize_input($_POST['message']);

  $errors = validate_input($firstname, $lastname, $email, $message);

  if (empty($errors)) {
    // Insert form data into the database
    $stmt = $db->prepare("INSERT INTO contacts (firstname, lastname, email, message) VALUES (:firstname, :lastname, :email, :message)");
    $stmt->execute(array(':firstname' => $firstname, ':lastname' => $lastname, ':email' => $email, ':message' => $message));

    // Check if insertion was successful
    if ($stmt->rowCount() > 0) {
      echo '<script>alert("Thank you for contacting us!");window.location.href="contacts.php";</script>';
    } else {
      echo '<script>alert("Sorry, an error occurred. Please try again later.");window.location.href="contacts.php";</script>';
    }
  } else {
    echo '<ul>';
    foreach ($errors as $error) {
      echo '<li>' . $error . '</li>';
    }
    echo '</ul>';
  }
}
?>
