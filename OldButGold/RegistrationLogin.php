<!DOCTYPE html>
<?php include_once "Config.php"; ?>
<head>
    <title>Registration/Login</title>
</head>
        <body>
        <center>
            <div>
                <form  method="post" action = "../UserDataEntry/RegistrationAuthorize.php">

                    Registration<br><br>

                    Username: <input type="text" id="username" name="username" maxlength="20" minlength="4" value="<?php
                    if (isset($_POST["username"])) {
                        echo $_POST["username"];
                    }
                    ?>" required>
                    <br><br>

                    Password: <input type="password" id="password" name="password" maxlength="20" minlength="8" value="<?php
                    if (isset($_POST["password"])) {
                        echo $_POST["password"];
                    }
                        ?>" required><br><br>
                    Repeat password: <input type="password" id="reppassword" name="reppassword" required/><br><br>

                    E-mail: <input type="email" id="usermail" name="usermail"value="<?php
                    if(isset($_POST["usermail"])){
                        echo $_POST['usermail'];
                    }
                    ?>" required/>
                    <br><br>
                    <?php
                        if(isset($_SESSION["error"])){
                            echo $_SESSION["error"];
                            $_SESSION["error"] = null;
                        }
                    ?>
                    <br><br>
                    <input type="submit" name="register" value="Submit"/><br><br>

                </form>
                <form method="post" action="../UserDataEntry/LoginAuthorize.php">

                    Login<br><br>

                    Username: <input type="text" id="logusername" name="logusername" value="<?php
                        if(isset($_POST["logusername"])){
                            echo $_POST["logusername"];
                        }
                    ?>" required/><br><br>

                    Password: <input type="password" id="logpassword" name="logpassword" required/><br><br>
                    <?php
                        if(isset($_SESSION["logerror"])){
                            echo $_SESSION["logerror"];
                        }
                    ?><br><br>
                    <input type="submit" name="login" value="Submit"/><br><br>

                </form>
            </div>
            <div>
                <a href="Index.php">
                    <input type="button" name="back" value="Back"/>
                </a>
            </div>
                </center>
        </body>
</html>