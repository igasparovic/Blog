<?php include_once "../Config.php";

$e=false;

if(isset($_POST["logusername"])) {
    $logusername = $_POST["logusername"];
    $logpassword = $_POST["logpassword"];

    $querry = $connection->prepare("SELECT * FROM users WHERE username=:logusername AND password=md5(:logpassword)");

    $querry->execute(array('logusername' => $logusername, 'logpassword' => $logpassword));

    $exists=$querry->fetch(PDO::FETCH_OBJ);
    if(!$exists){
        $e=true;
        $_SESSION["logerror"] = "Username or password do not match";
        header("location: ../Login.php");
        exit();
    }
}

if($e == false){
    $_SESSION["username"] = $logusername;
    header("location: ../index.php");
    $_SESSION["userquote"] = $exists->quote;
    if($exists->admin){
        $_SESSION["admin"] = true;
    }

}