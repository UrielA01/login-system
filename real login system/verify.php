<?php
if(isset($_POST['submit'])){
$linkid = $_GET['linkid'];
$servername = "mysql.hostinger.co.il";
$dbname = "u486936244_login";
$dbusername = "u486936244_uriel";
$dbpassword = "uriel1811";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM users WHERE linkid=:linkid;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':linkid',$linkid);
    $result = $stmt->execute();
    if($result){
    $null = NULL;
    $sql = "UPDATE users SET linkid=:null WHERE linkid=:linkid;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':linkid',$linkid);
    $stmt->bindParam(':null',$null);
    $stmt->execute();
        header("location:wrong.php?emailver");
    }else{
        echo'your email is verifyed!';
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
