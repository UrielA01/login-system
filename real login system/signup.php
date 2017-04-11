<?php
session_start();
if(isset($_POST['submit'])){
    function post_captcha($user_response) {
        $fields_string = '';
        $fields = array(
            'secret' => '6Le4JRsUAAAAAK9kitQC9FcldRtHM4Vfvgjp5L9E',
            'response' => $user_response
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

    // Call the function post_captcha
    $res = post_captcha($_POST['g-recaptcha-response']);

    if (!$res['success']) {
        // What happens when the CAPTCHA wasn't checked
        echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
    } else {
        // If CAPTCHA is successfully completed...
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$servername = "mysql.hostinger.co.il";
$dbname = "u486936244_login";
$dbusername = "u486936244_uriel";
$dbpassword = "uriel1811";
$hashpass = password_hash($password, PASSWORD_DEFAULT);
if (preg_match("/[^A-z_0-9]/", $username)||preg_match("/[^A-z_0-9_@_.]/", $email)){
        header("location: wrong.php?error=wrong");
    exit();
}elseif(empty($username)||empty($password)||empty($email)){
     header("location: wrong.php?error=emptyfield");
    exit();
}else{
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $checkuser = $conn->prepare("SELECT username FROM users WHERE username = :username LIMIT 1");
    $checkuser->bindParam(':username', $username);
    $checkuser->execute();
     
    $checkemail = $conn->prepare("SELECT email FROM users WHERE email = :email LIMIT 1");
    $checkemail->bindParam(':email', $email);
    $checkemail->execute();
     
    if($row2 = $checkemail->fetchColumn()||$row = $checkuser->fetchColumn()){
        $conn = null;
    header("location: wrong.php?error=usernametaken");
    exit();
    }
    $linkid = md5($username.time().rand());
    $sql = "INSERT INTO users (username, pass, email, linkid)
    VALUES (:username, :password, :email,:linkid)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashpass);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':linkid', $linkid);
    $stmt->execute();
    $msg = "hello! please verify your email with this link: http://somepage.esy.es/verify.php?linkid=$linkid";
    mail($email, "verify your email", $msg);
    header("Location: wrong.php?addmember");
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
    $conn = null;
}
}
    }else{
    header("Location: wrong.php");
}
    

?>
