
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contacts.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Contact Us</title>
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
<div class="container">
  <div class="contact-section">
    <h2 class="ct-section-head">CONTACT US</h2>
    <div class="row contact-fields">
      <div class="col-md-8 left-form">

<form method="post" action="process-form.php">
<div class="form-group">
  <label for="firstname">First Name:</label>
  <input  class="required form-control" type="text" id="firstname" name="firstname" required>
  </div>
        <div class="form-group">

  <label for="lastname">Last Name:</label>
  <input  class="required form-control" type="text" id="lastname" name="lastname" required>
  </div>
        <div class="form-group">

  <label for="email">Email:</label>
  <input class="required form-control h5-email" type="email" id="email" name="email" required>
  </div>
        <div class="form-group">
        <label for="message">Message:</label>
  <textarea  class="required form-control" id="message" name="message" required></textarea>

  </div>
        <button class="btn btn-accent" type="submit">Submit</button>  
      </form>
    </div>
    <div class="col-md-4 contact-info">
      <div class="phone">
        <h2>Call</h2>
        <a href="tel:+20400000000">(204)-0000-0000</a>
      </div>
      <div class="email">
        <h2>Email</h2>
        <a href="mailto:foodyref@mail.com">foodyref@mail.com</a>
      </div>
      <div class="location">
        <h2>Visit</h2>
        <p>Winnipeg, Manitoba</p>
        <br>
      </div>
    </div>
  </div>
</div>
</form>
</body>
</html>
