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
        $headImg = "images/nophoto.jpg";
        if(isset($_POST["SaveDraft"])){
            $draft = true;
        }
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
                    list($width, $height) = getimagesize("../userfiles/" . $username . "/" . $picName);
                    if ($width > 860 or $height > 640) {
                        unlink("../userfiles/" . $username . "/" . $picName);
                        $_SESSION["error"] = "Image is too large";
                        $error = true;
                    } else {
                        $headImg = "userfiles/" . $username . "/" . $picName;
                    }
                } else {
                    $_SESSION["error"] = "File is too big";
                    $error = true;
                }
            } else {
                $_SESSION["error"] = "Wrong format for head picture, only .jpg is allowed";
                $error = true;
            }
        }
        if ($error == true) {
            $draft = true;
        }
        try {
            if (isset($_SESSION["draft"])) {
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
                header("location: ../PreviewPost.php");
            }else {
                $_SESSION["draft"] = null;
                header("location: ../MyBlog.php");
            }
        }
    }
}else{
    $_SESSION["error"] = "Blog needs to have at least a title and some body text to be saved as draft.";
    header("location: ../CreateBlogPost.php");
}
