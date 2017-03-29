<?php include('logic.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Contact form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
     
<div id="form-content" class="container">  
  <form id="contact" onsubmit="submitForm(); return false;" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
    <a href=""><h3>Quick Contact</h3></a>
    <h4>Contact us today, and get reply with in 24 hours!</h4>
    <fieldset>
      <input id="n" placeholder="Your name" type="text" tabindex="1" name="name" value="<?= $name ?>" autofocus>
      <span class="error"><?= $name_error ?></span>
    </fieldset>
    <fieldset>
      <input id="e" placeholder="Your Email Address" type="text" tabindex="2" name="email_set" 
      value="<?= $email_set ?>">
      <span class="error"><?= $email_error ?></span>
    </fieldset>
     <fieldset>
      <input id="e2" placeholder="Repeat Your Email Address" type="text" tabindex="3" name="email_confirm" 
      value="<?= $email_confirm ?>">
      <span class="error"><?= $email_confirm_error ?></span>
    </fieldset>
    <fieldset>
    <label for="phone">Пример ввода +38(093)-XXX-XX-XX:</label><br/>
      <input id="ph" placeholder="+38(093)-XXX-XX-XX" type="text" tabindex="4" name="phone" pattern="\+([0-9]{1,3})(\([0-9]{2,3}\))-([0-9]{3})-([0-9]{2})-([0-9]{2})" value="<?= $phone ?>">
      <span class="error"><?= $phone_error ?></span>
    </fieldset>
  <fieldset>
      <textarea id="m" placeholder="Type your Message Here...." type="text" tabindex="5" name="msg"><?= $msg ?></textarea>
      <span class="error"><?= $msg_error ?></span>
    </fieldset>
    <fieldset>
      <button id="btn" name="submit" type="submit"  data-submit="...Sending">Submit</button>
    </fieldset>
    <div id="status" class="success"><?= isset($_SESSION['success']) ? $_SESSION['success'] : ''; ?></div>
  </form>
</div>
</body>
</html>

<?php 
  
 sessionDie(); 

?>

