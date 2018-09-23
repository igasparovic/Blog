<?php
include_once "../Config.php";

if (isset($_SESSION["username"]) AND isset($_POST["content"]) AND trim($_POST["content"] != null)) {

    if (isset($_POST["SavePost"]) or isset($_POST["SaveDraft"]) or isset($_POST["Preview"])) {
        $username = $_SESSION["username"];
        $post = $_POST["content"];
        $title = $_POST["title"];
        $summary = $_POST["summary"];
        $error = false;
        $draft = false;
        $exists = false;
        $replace= false;
        $update1 = null;
        if(isset($_SESSION["edit"])){
            $draftQuery = $connection->prepare("SELECT * FROM blogposts WHERE postid=:postid");
            $draftQuery->execute(array('postid' => $_SESSION{"draft"}));
            $draft = $draftQuery->fetch(PDO::FETCH_ASSOC);
        }
        if(isset($_SESSION["draft"])){
            $picQuery = $connection->prepare("SELECT headpicture FROM blogposts WHERE postid=:postid");
            $picQuery->execute(array('postid' => $_SESSION{"draft"}));
            $picture = $picQuery->fetch(PDO::FETCH_OBJ);
            $headImg = $picture->headpicture;
        }
        if (isset($_SESSION["draft"]) AND isset($_FILES["file"]) AND $_FILES["file"]["name"] != null ) {
            $picName = $_FILES["file"]["name"];
            $fileDestination = "userfiles/" . $username . "/" . $picName;
            if($headImg === $fileDestination){
                $exists = true;
                $oldpic = rename($fileDestination, "OldPicture" );
            }else {
                if ($headImg !== "images/nophoto.jpg") {
                    $replace = true;
                }
            }
        }else {
            if (isset($_SESSION["draft"])){
                $headImg = $picture->headpicture;
            }else{
                $headImg = "images/nophoto.jpg";
            }
        }

        if(isset($_FILES["file"]) AND $_FILES["file"]["name"] != null) {
            $picName = $_FILES["file"]["name"];
            $picTmpName = $_FILES["file"]["tmp_name"];
            $picSize = $_FILES["file"]["size"];
            $picExt = explode('.', $picName);
            $picActualExt = strtolower(end($picExt));
            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            list($width,$height) = getimagesize($picTmpName);
                if (in_array($picActualExt, $allowed)) {
                    if ($picSize < 500000) {
                        $fileDestination = "../userfiles/" . $username . "/" . $picName;
                            if($exists == true){
                                unlink($oldpic);
                            }
                            if($replace == true){
                                unlink($headImg);
                            }
                            move_uploaded_file($picTmpName, $fileDestination);
                            $headImg = "userfiles/" . $username . "/" . $picName;

                        }else {
                        if ($exists == true){
                            rename($oldpic, $fileDestination);
                        }
                        $_SESSION["error"] = "File is too big";
                        $error = true;
                        }
                    } else {
                            if ($exists == true){
                                rename($oldpic, $fileDestination);
                            }
                    $_SESSION["error"] = "Wrong format, allowed formats are jpg,jpeg,png and gif.";
                    $error = true;
                }
            }
        if(isset($_POST["SaveDraft"]) OR isset($_POST["Preview"]) ){
            $draft = true;

        }
        if ($error == true ) {
            $draft = true;
                if (isset($_SESSION["edit"])) {
                    $update1 = false;
            }
        }else{
            if(isset($_SESSION["edit"]) AND isset($_POST["SavePost"])){
                if($draft[0]['draft'] == true) {
                    $original = $draft[0]['editid'];
                    $update1 = true;
                }else{
                    $original = $_SESSION["draft"];
                    $update1 = true;
                }
            }
            if(isset($_SESSION["edit"]) AND isset($_POST["SaveDraft"])){
                $update1 = false;
                echo $update1;
            }
        }
        echo $update1;
        try {
            if (isset($_SESSION["draft"])) {
                echo $update1;
                if($update1 = null) {
                    $update = $connection->prepare("UPDATE blogposts SET username=:username, post=:post,title=:title,summary=:summary,headpicture=:headpicture, timestamp=current_timestamp , draft=:draft WHERE postid=:postid");

                    $update->execute(array(
                        'username' => $username,
                        'post' => $post,
                        'title' => $title,
                        'summary' => $summary,
                        'headpicture' => $headImg,
                        'draft' => $draft,
                        'postid' => $_SESSION["draft"]
                    ));
                }
                if ($update1 == true) {
                    $update = $connection->prepare("UPDATE blogposts SET username=:username, post=:post,title=:title,summary=:summary,headpicture=:headpicture, timestamp=current_timestamp , draft=:draft WHERE postid=:postid");

                    $update->execute(array(
                        'username' => $username,
                        'post' => $post,
                        'title' => $title,
                        'summary' => $summary,
                        'headpicture' => $headImg,
                        'draft' => $draft,
                        'postid' => $original
                    ));
                        $delete = $connection->prepare("DELETE FROM blogposts WHERE postid=:postid");

                        $delete->execute(array(
                            'postid' => $_SESSION["draft"]
                        ));

                }
                if($update1 == false){
                    $insert = $connection->prepare("INSERT INTO blogposts (username, post,title,summary,headpicture, timestamp,draft,editid ) VALUES 
                                                         (:username, :post,:title,:summary,:headpicture, current_timestamp,:draft,:editid )");
                    $insert->execute(array(
                        'username' => $username,
                        'post' => $post,
                        'title' => $title,
                        'summary' => $summary,
                        'headpicture' => $headImg,
                        'draft' => $draft,
                        'editid' => $_SESSION["draft"]
                    ));
                }
                    $_SESSION["draft"] = null;
            } else {
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
        } catch (PDOException $e) {
            echo $e;
        }

        if ($error == true) {
            if (isset($_SESSION["draft"])) {
                if(isset($_POST["SaveDraft"])){
                    header("location: ../ViewDrafts.php");
                }elseif(isset($_POST["Preview"])) {
                    header("location: ../PreviewPost.php");
                }
                else{
                    header("location: ../CreateBlogPost.php");
                }
            } else {
                if(isset($_POST["SaveDraft"])){
                    header("location: ../ViewDrafts.php");
                } else {
                    $returnQuerry = $connection->prepare("SELECT * FROM blogposts WHERE username=:username AND title=:title AND post=:post");
                    $returnQuerry->execute(array(
                        'username' => $username,
                        'title' => $title,
                        'post' => $post
                    ));
                    $draftResult = $returnQuerry->fetch(PDO::FETCH_OBJ);
                    $_SESSION["draft"] = $draftResult->postid;
                    if(isset($_POST["Preview"])) {
                        header("location: ../PreviewPost.php");
                    }else {
                        header("location: ../CreateBlogPost.php");
                    }
                }
            }
        } else {
            if(isset($_POST["SaveDraft"])){
                header("location: ../ViewDrafts.php");
            }elseif(isset($_POST["Preview"])) {
                $returnQuerry = $connection->prepare("SELECT * FROM blogposts WHERE username=:username AND title=:title AND post=:post");
                $returnQuerry->execute(array(
                    'username' => $username,
                    'title' => $title,
                    'post' => $post
                ));
                $draftResult = $returnQuerry->fetch(PDO::FETCH_OBJ);
                $_SESSION["draft"] = $draftResult->postid;
                header("location: ../PreviewPost.php");
            }else {
                $_SESSION["draft"] = null;
                header("location: ../MyBlog.php");
            }
        }
    }elseif(isset($_POST["Cancel"])){
        if(isset($_SESSION["draft"])){
            $delete = $connection->prepare("DELETE FROM blogposts WHERE postid=:postid");

            $delete->execute(array(
                'postid' => $_SESSION["draft"]
            ));
            header("location: ../ViewDrafts.php");
        }else{
            $_SESSION["error"] = "Post was successfully discarded. ";
            header("location: ../CreateBlogPost.php");
        }
    }
}else{
    $_SESSION["error"] = "Blog needs to have at least a title and some body text to be saved as draft.";
    header("location: ../CreateBlogPost.php");
}
