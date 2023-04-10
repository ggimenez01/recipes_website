<?php

//process_data.php

if(isset($_POST["comment_name"]))
{
 $comment_name = '';
 $comment_message = '';


 $comment_name_error = '';
 $comment_message_error = '';
 
 $captcha_error = '';

 if(empty($_POST["comment_name"]))
 {
  $comment_name_error = 'Comment is required';
 }
 else
 {
  $comment_name = $_POST["comment_name"];
 }

 if(empty($_POST["comment_message"]))
 {
  $comment_message_error = 'Comment Required';
 }
 else
 {
  $comment_message = $_POST["comment_message"];
 }
 
 

 if(empty($_POST['g-recaptcha-response']))
 {
  $captcha_error = 'Captcha is required';
 }
 else
 {
  $secret_key = '6Ldv2bcUAAAAAFXUKdLW_qljFd9FpxNguf06DHhp';

  $response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$_POST['g-recaptcha-response']);

  $response_data = json_decode($response);

  if(!$response_data->success)
  {
   $captcha_error = 'Captcha verification failed';
  }
 }

 if($comment_name_error == '' && $comment_message_error == ''  && $captcha_error == '')
 {
  $data = array(
   'success'  => true
  );
 }
 else
 {
  $data = array(
   'comment_name_error' => $comment_name_error,
   'comment_message_error' => $comment_message_error,

   'captcha_error'  => $captcha_error
  );
 }

 echo json_encode($data);
}

?>
