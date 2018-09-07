<?php
include_once "../Config.php";

if (isset($_SESSION["username"]) AND isset($_POST["content"]) AND trim($_POST["content"] != null)) {
    if(isset($_POST["SaveDraft"])){
        $draft = true;
    }else{
        $draft = false;
    }
    $username = $_SESSION["username"];
    $post = $_POST["content"];
    $title = $_POST["title"];
    $summary = $_POST["summary"];
    $draft = false;
    if (isset($_FILES["file"])) {
        $picName = $_FILES["file"]["name"];
        $picTmpName = $_FILES["file"]["tmp_name"];
        $picSize = $_FILES["file"]["size"];
        $picExt = explode('.', $picName);
        $picActualExt = strtolower(end($picExt));
        $allowed = array('jpg');
        if (in_array($picActualExt, $allowed)) {
            if ($picSize < 500000) {
                $fileDestination = "../userfiles/" . $username . "/" . $picName;
                    move_uploaded_file($picTmpName, $fileDestination);
                    list($width,$height) = getimagesize("../userfiles/" . $username ."/". $picName);
                    if ($width > 1280 or $height > 720){
                        unlink("../userfiles/" . $username ."/". $picName);
                        $_SESSION["error"] = "Image is too large";
                        $_draft = true;
                    }else{
                        $headImg = "/userfiles/". $username . "/" . $picName;
                    }
            } else {
                $_SESSION["error"] = "File is too big";
                $_draft = true;
            }
        } else {
            $_SESSION["error"] = "Wrong format, only .jpg is allowed";
            $_draft = true;
        }
    }

    try {
        $insert = $connection->prepare("INSERT INTO blogposts (username, post,title,summary,headpicture, timestamp,draft ) VALUES 
                                         (:username, :post,:title,:summary,:headpicture, current_timestamp,:draft )");

        $insert->execute(array(
                'username' => $username,
                'post' => $post,
                'title' => $title,
                'summary' => $summary,
                'headpicture' => $headImg,
                'draft' => $draft
            ));
        }
        catch (PDOException $e) {
            echo "Cant";
        }

        if($draft == true) {
            $returnQuerry = $connection->prepare("SELECT * FROM blogposts WHERE username=:username AND title=:title AND post=:post");
            $draftReturn = $returnQuerry->execute(array(
               'username' => $username,
               'title' => $title,
               'post' => $post
            ));
        } else {
            header("location: ../MyBlog.php");
        }
}
