<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
</head>

<body>
    <?php
    $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if(isset($_SESSION['username'])){
        echo'Hello, '.$_SESSION['username'];
        echo'<style>
        .signup{
            display: none;
        }
        .login{display: none;}
        .loginout{display: block;}
    </style>';
        setcookie("username","", time()-(10*365*24*60*60));
        setcookie("password","", time()-(10*365*24*60*60));
    }
    elseif(isset($_COOKIE['username'])&&isset($_COOKIE['password'])){
        echo'Hello, '.$_COOKIE['username'];
        echo'<style>
        .signup{
            display: none;
            
        }
        .login{display: none;}
        .loginout{display: block;}
    </style>';
    }
    else{
         echo'you are not logged in yet!</br>
         <style>
        .signup{
            display: block;
            
        }
        .login{display: block;}
        .logout{display: none;}
        .changepass{display: none;}
    </style>';
    }
    ?>
    <a href="changepass.php" class="changepass">change email or password</a>
        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" class="signup">Sign up</button>
    <div id="id01" class="modal">
  
  <form method="post" class="modal-content animate" action="signup.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        <label><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>
        <div id="RecaptchaField1" class="g-recaptcha" data-sitekey="6Le4JRsUAAAAAL7vePaBYTxBvijY_tBAy0LBqF2Z"></div>
        <input name="submit" type="submit" value="Sign up" style="width:100%;">
      </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>
    <br><br><br>

<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;" class="login">Login</button>
<form method="post" action="loguot.php" class="logout">
        <input name="submit" type="submit" value="Logout"><br>
</form>
<div id="id02" class="modal">
  
  <form method="post" class="modal-content animate" action="login.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        <div id="RecaptchaField2" class="g-recaptcha" data-sitekey="6Le4JRsUAAAAAL7vePaBYTxBvijY_tBAy0LBqF2Z"></div>
      <input name="submit" type="submit" value="Login" style="width:100%;"/>
        <a href="forgotpass.html" class="forgot">forgot your password?</a>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>
    
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
var CaptchaCallback = function() {
        grecaptcha.render('RecaptchaField1', {'sitekey' : '6Le4JRsUAAAAAL7vePaBYTxBvijY_tBAy0LBqF2Z'});
        grecaptcha.render('RecaptchaField2', {'sitekey' : '6Le4JRsUAAAAAL7vePaBYTxBvijY_tBAy0LBqF2Z'});
    };
</script>
</body>
</html>

