<?php
session_start();
if(isset($_POST['submit'])){
$servername = "";
$dbname = "";
$dbusername = "";
$dbpassword = "";
$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];
$newemail = $_POST['nememail'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM users WHERE username=:username;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $_SESSION['username']);
    $result = $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $hashed_pwd = $row['pass'];
    $hashcheck = password_verify($oldpass, $hashed_pwd);
    if($hashcheck==0){
        header("location: wrong.php?passnotmatch");
        exit();
    }else{
        if(empty($newpass)&& empty($newemail)){
        header("location: wrong.php?allempty");
        exit();
        }
        elseif(!empty($newpass) && empty($newemail)){
            $hashedpass = password_hash($newpass, PASSWORD_DEFAULT);
            $sql="UPDATE users SET pass=:newpass WHERE username=:username;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $_SESSION['username']);
            $stmt->bindParam(':newpass', $hashedpass);
            $stmt->execute();
            header("location: welcome.php?passup");
        }
        elseif(empty($newpass) && !empty($newemail)){
            $sql="UPDATE users SET email=:newemail WHERE username=:username;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $_SESSION['username']);
            $stmt->bindParam(':newemail', $newemail);
            $stmt->execute();
            header("location: welcome.php?emailup");
        }elseif(!empty($newpass) && !empty($newemail)){
            $sql="UPDATE users SET email=:newemail WHERE username=:username;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $_SESSION['username']);
            $stmt->bindParam(':newemail', $newemail);
            $stmt->execute();
            $hashedpass = password_hash($newpass, PASSWORD_DEFAULT);
            $sql="UPDATE users SET pass=:newpass WHERE username=:username;";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $_SESSION['username']);
            $stmt->bindParam(':newpass', $hashedpass);
            $stmt->execute();
            header("location: welcome.php?2up");
        }
    }
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
}else{
    header("location:welcome.php");
}
?>
