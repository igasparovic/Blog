<?php
include_once "../Config.php";
$e=false;

if(isset($_POST["username"])){
    $username = $_POST["username"];
    $userquerry = $connection->prepare("SELECT * FROM users WHERE username=:username ;");
    $userquerry->execute(array('username' => $username));
    $userexists=$userquerry->fetch(PDO::FETCH_OBJ);
    if($userexists){
        $e=true;
        $_SESSION["error"] = "The username is taken";
        header("location: ../Registration.php");
        exit();
    }
}

if(isset($_POST["usermail"])){
    $usermail = $_POST["usermail"];
    $mailquerry = $connection->prepare("SELECT * FROM users WHERE email=:usermail ;");
    $mailquerry->execute(array('usermail' => $usermail));
    $mailexists=$mailquerry->fetch(PDO::FETCH_OBJ);
    if($mailexists){
        $e=true;
        $_SESSION["error"] = "This e-mail address is already registered";
        header("location: ../Registration.php");
        exit();
    }
}

if(isset($_POST["password"]) and isset($_POST["reppassword"])) {
    if (trim($_POST["password"]) == "" or trim($_POST["reppassword"]) == "") {
        echo("All fields are required");
        $e = true;
        $_SESSION["error"] = "All fields are required";
        header("location: ../Registration.php");
        exit();
    }
    if (($_POST["password"]) != ($_POST["reppassword"])) {
        $e = true;
        $_SESSION["error"] = "Passwords do not match";
        header("location: ../Registration.php");
        exit();
    }
}

if ($e == false) {
        $validation = session_id();

        $insert = $connection->prepare("
            INSERT INTO users (username, password, email, admin, active, sessionverification) VALUES
                                  (:username,md5(:password),:email, false, false, :validation );
    ");

        $insert->execute(array(
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'email' => $_POST['usermail'],
            'validation' => $validation
        ));
        mkdir('../userfiles/' . $username, 0775);
        header("location: ../Login.php");


}




