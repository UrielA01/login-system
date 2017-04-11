<?php
session_start();
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
     <form method="post" action="changepassoremail.php">
        <label><b>old password*</b></label>
     <input type="password" placeholder="Enter old password" name="oldpass" required>
         <input type="password" placeholder="Enter new password" name="newpass" required>
         <input type="email" placeholder="Enter new email" name="nememail">
        
        <input name="submit" type="submit" value="Change password" style="width:100%;">
  </form>
</body>
</html>
