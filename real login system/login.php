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
       header("location: wrong.php?error=nocaptcha");
    } else {
        // If CAPTCHA is successfully completed...

       $servername = "mysql.hostinger.co.il";
$dbname = "u486936244_login";
$dbusername = "u486936244_uriel";
$dbpassword = "uriel1811";
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM users WHERE username=:username;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $result = $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!isset($row['linkid'])){
    $hashed_pwd = $row['pass'];
    $hashcheck = password_verify($password, $hashed_pwd);
    if($hashcheck == 0){
    header("location: wrong.php?error=incorrect");
    exit();

    }else{

    $sql = "SELECT * FROM users WHERE  username=:username AND pass=:hashed;";
    $result =   $conn->prepare($sql);
    $result->bindParam(':hashed', $hashed_pwd);
    $result->bindParam(':username', $username);
    $result->execute();
    if(!$row = $result->fetch(PDO::FETCH_ASSOC)){
        header("location: wrong.php?notlogin");
        exit();
    }else{
        if(isset($_SESSION['username'])){
            header("location: wrong.php?error=alreadylogin");
            exit();
        }
        elseif(!empty($remember_me)){
            setcookie("username", $username, time()+(10*365*24*60*60));
            setcookie("password", $password, time()+(10*365*24*60*60));
            header("location: welcome.php?login");
            exit();
        }else{
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        header("location: welcome.php?login");
        }
    }
}
    }else{
        header("Location: wrong.php?error=notverifyed");
    }
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
}
}else{
    header("Location: welcome.php?ddf");
}


?>
