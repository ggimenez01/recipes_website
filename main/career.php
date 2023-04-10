<?php
$jobs = array(
    array(
      'title' => 'Web Developer',
      'description' => 'We are looking for an experienced web developer to join our team. The ideal candidate will have a strong background in web development and a passion for creating high-quality websites.',
      'location' => 'New York, NY',
      'requirements' => 'Bachelor\'s degree in Computer Science or related field, 3+ years of experience in web development, knowledge of HTML, CSS, JavaScript, and PHP.'
    ),
    array(
      'title' => 'Marketing Manager',
      'description' => 'We are seeking a marketing manager to help develop and implement our marketing strategy. The ideal candidate will have experience in marketing, strong communication skills, and a creative approach to problem-solving.',
      'location' => 'San Francisco, CA',
      'requirements' => 'Bachelor\'s degree in Marketing or related field, 5+ years of experience in marketing, strong communication skills, experience with digital marketing and social media.'
    )
  );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="career.css">
    <title>Job Posting</title>
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
        <div class="job-listings">
            <?php foreach ($jobs as $job): ?>
                <div class="job">
                    <h2><?php echo $job['title']; ?></h2>
                    <p><?php echo $job['description']; ?></p>
                    <ul>
                        <li><strong>Location:</strong> <?php echo $job['location']; ?></li>
                        <li><strong>Requirements:</strong> <?php echo $job['requirements']; ?></li>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="apply-form">
            <h2>Apply for a job</h2>
            <form action="apply.php" method="post" enctype="multipart/form-data">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="phone_number">Phone Number</label>
                <input type="tel" id="phone_number" name="phone_number" required>

                <label for="resume">Resume</label>
                <input type="file" id="resume" name="resume" required>

                <label for="cover_letter">Cover Letter</label>
                <textarea id="cover_letter" name="cover_letter" rows="10"></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
