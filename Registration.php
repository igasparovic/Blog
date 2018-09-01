<?php include_once "Config.php" ?>
<!DOCTYPE HTML>
<html>
    <?php include_once "Include/Head.php" ?>
    <body class="single is-preload">

        <!-- Wrapper -->
        <div id="wrapper">
            <!-- Header -->
            <?php include_once "Include/Header.php" ?>
            <!-- Main -->
            <div id="main">
                <!-- Post -->
                <article class="post">
                    <form  method="post" action = "UserDataEntry/RegistrationAuthorize.php">

                        <h1><label>Register</label></h1><br>

                        <label>
                            Username: <input type="text" id="username" name="username" maxlength="20" minlength="4" value="<?php
                                                if (isset($_POST["username"])) {
                                                    echo $_POST["username"];
                                                }
                                                 ?>"required>

                        </label>
                        <label>
                            Password: <input type="password" id="password" name="password" maxlength="20" minlength="8"  required>
                            Repeat password: <input type="password" id="reppassword" name="reppassword" required/>
                        </label>
                        <label>E-mail: <input type="email" id="usermail" name="usermail" required/></label>
                        <br>
                        <?php
                                if(isset($_SESSION["error"])){
                                    echo $_SESSION["error"];
                                    $_SESSION["error"] = null;
                                }
                        ?>
                        <br>
                        <input type="submit" name="register" value="Submit"/><br><br>

                    </form>
                </article>
            </div>
            <!-- Footer -->
            <?php include_once "Include/Footer.php" ?>
        </div>

    <!-- Scripts -->
        <?php include_once "Include/Scripts.php"?>

    </body>
</html>