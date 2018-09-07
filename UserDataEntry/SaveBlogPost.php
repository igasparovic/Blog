<?php
include_once "../Config.php";

if(isset($_POST["SavePost"])) {
    if (isset($_SESSION["username"]) AND isset($_POST["content"]) AND trim($_POST["content"] != null)) {
        $username = $_SESSION["username"];
        $post = $_POST["content"];
        try {
            $insert = $connection->prepare("INSERT INTO blogposts (username, post, timestamp,draft ) VALUES 
                                         (:username, :post, current_timestamp,false )");

            $insert->execute(array(
                'username' => $username,
                'post' => $post
            ));
        } catch (PDOException $e) {
            echo "Cant";
        }
    }
}

if(isset($_POST["SaveDraft"])){
        if (isset($_SESSION["username"]) AND isset($_POST["content"]) AND trim($_POST["content"] != null)) {
            $username = $_SESSION["username"];
            $post = $_POST["content"];
            try {
                $insert = $connection->prepare("INSERT INTO blogposts (username, post, timestamp, draft ) VALUES 
                                         (:username, :post, current_timestamp,true)");

                $insert->execute(array(
                    'username' => $username,
                    'post' => $post
                ));
            } catch (PDOException $e) {
                echo "Cant";
            }
        }
}
