<?php
include_once "../Config.php";

if(isset($_SESSION["username"]) AND isset($_POST["content"]) AND trim($_POST["content"] != null)){
    $username= $_SESSION["username"];
    $post = $_POST["content"];
    try {
        $insert = $connection->prepare("INSERT INTO blogposts (username, post, timestamp ) VALUES 
                                     (:username, :post, current_timestamp )");

        $insert->execute(array(
            'username' => $username,
            'post' => $post

        ));
    } catch(PDOException $e){
        echo "Cant";
    }
}