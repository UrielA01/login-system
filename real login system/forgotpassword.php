<?php
$email = $_POST['email2'];
$servername = "";
$dbname = "";
$dbusername = "";
$dbpassword = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql= "SELECT * FROM users WHERE email = :email"; 
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_INT); 
    $stmt->execute();
    if($stmt->fetchColumn() > 0){
        function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }
        $newpass=generateRandomString(10);
        $hash_pass = password_hash($newpass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE users SET pass=:password WHERE email=:email");
        $stmt->bindParam(':password', $hash_pass);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $message = "
        <html>
        <head>
        <title>HTML email</title>
        </head>
        <body>
        <p>hello ".$email."</p>
        <p>your new password is ".$newpass."</p>
        <p>that wasn't you? you screwed up!</p>
        </body>
        </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        mail($email, "new password request!", $message, $headers);
        header("Location: welcome.php");
    }else{
        header("location: wrong.php?error=wrongemail");
    }
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
