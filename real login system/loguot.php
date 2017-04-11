<?php
if(isset($_POST['submit'])){
setcookie("username","", time()-(10*365*24*60*60));
setcookie("password","", time()-(10*365*24*60*60));
session_start();
session_destroy();    
header("location: welcome.php");
}else{
header("Location: welcome.php");
}
?>