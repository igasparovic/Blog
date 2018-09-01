<?php
include_once "../Config.php";
$e=false;

$username = $_SESSION["username"];
$querry = $connection->prepare("SELECT * FROM users WHERE username=:username");
$querry->execute(array('username' => $username));
$user = $querry->fetch(PDO::FETCH_OBJ);

if($user) {
    if(isset($_POST["save"])) {
        $querry = $connection->prepare("UPDATE users SET email=:email,firstname=:firstname,lastname=:lastname,country=:country,state=:state,city=:city,gender=:gender,quote=:quote WHERE username=:username");
        $querry->execute(array('email' => $_POST["email"], 'firstname' => $_POST["firstname"],
            'lastname' => $_POST["lastname"], 'country' => $_POST["country"],
            'state' => $_POST["state"], 'city' => $_POST["city"],
            'gender' => $_POST["gender"], 'quote' => $_POST["quote"], "username" => $username));
            if(isset($_POST["quote"])) {
                $_SESSION["userquote"] = $_POST["quote"];
            }

        if (isset($_FILES["file"])) {
            $avatarName = $_FILES["file"]["name"];
            $avatarTmpName = $_FILES["file"]["tmp_name"];
            $avatarSize = $_FILES["file"]["size"];
            $avatarError = $_FILES["file"]["error"];
            $avatarExt = explode('.', $avatarName);
            $avatarActualExt = strtolower(end($avatarExt));
            $allowed = array('jpg');
            if (in_array($avatarActualExt, $allowed)) {
                if ($avatarSize < 500000) {
                    $fileDestination = "../userfiles/" . $username . "/" . $avatarName;
                    if (file_exists("../userfiles/" . $username . "/avatar.jpg")) {
                        rename("../userfiles/" . $username . "/avatar.jpg","../userfiles/" . $username . "/avatarOld.jpg");
                        move_uploaded_file($avatarTmpName, $fileDestination);
                        rename("../userfiles/" . $username ."/".$avatarName, "../userfiles/" . $username ."/"."avatar.jpg");
                        list($width,$height) = getimagesize("../userfiles/" . $username ."/"."avatar.jpg");
                        if ($width > 700 or $height > 700){
                                unlink("../userfiles/" . $username . "/avatar.jpg");
                                rename("../userfiles/" . $username . "/avatarOld.jpg","../userfiles/" . $username . "/avatar.jpg");
                                $e = true;
                                $_SESSION["error"] = "Image is too large";
                                header("location: ../UserSettings.php");
                        }else{
                            unlink("../userfiles/" . $username . "/avatarOld.jpg");
                            header("location: ../UserSettings.php");
                        }
                    }else {
                        move_uploaded_file($avatarTmpName, $fileDestination);
                        rename("../userfiles/" . $username . "/" . $avatarName, "../userfiles/" . $username . "/" . "avatar.jpg");
                        list($width,$height) = getimagesize("../userfiles/" . $username ."/"."avatar.jpg");
                        if ($width > 700 or $height > 700){
                            unlink("../userfiles/" . $username . "/avatar.jpg");
                            $e = true;
                            $_SESSION["error"] = "Image is too large";
                            header("location: ../UserSettings.php");
                        }else{
                            header("location: ../UserSettings.php");
                        }
                    }
                } else {
                    $e = true;
                    $_SESSION["error"] = "File is too big";
                    header("location: ../UserSettings.php");
                }
            } else {
                $e = true;
                $_SESSION["error"] = "Wrong format, only .jpg is allowed";
                header("location: ../UserSettings.php");
            }
        }
    }

    if(isset($_POST["changepw"])){
        if(isset($_POST["newpassword"]) AND isset($_POST["newreppassword"]) AND isset($_POST["currpassword"])) {
            if (trim($_POST["newpassword"]) == "" or trim($_POST["newreppassword"]) == "") {
                echo("All fields are required");
                $e = true;
                $_SESSION["error"] = "All fields are required";
                header("location: ../UserSettings.php");
                exit();
            }
            if (($_POST["newpassword"]) != ($_POST["newreppassword"])) {
                $e = true;
                $_SESSION["error"] = "Passwords do not match";
                header("location: ../UserSettings.php");
                exit();
            }
            if(md5($_POST["currpassword"]) != $user->password){
                $e = true;
                $_SESSION["error"] = "Current password is incorrect";
                header("location: ../UserSettings.php");
                exit();
            }
        }

        if($e == false){
            $querry = $connection->prepare("UPDATE users SET password=md5(:password) WHERE username=:username");
            $querry->execute(array('password'=> $_POST["newpassword"], 'username' => $username));
            header("location: ../UserSettings.php");
        }
    }

    header("location: ../UserSettings.php");
}