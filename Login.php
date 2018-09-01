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
                    <form method="post" action="UserDataEntry/LoginAuthorize.php">

                        <h1><label>Login</label></h1><br>

                        <label>Username: <input type="text" id="logusername" name="logusername"  required/><br></label>

                        <label>Password: <input type="password" id="logpassword" name="logpassword" required/><br></label>

                        <input type="submit" name="login" value="Submit"/><br><br>
                        <?php
                        if(isset($_SESSION["logerror"])){
                            echo $_SESSION["logerror"];
                            $_SESSION["logerror"] = null;
                        }
                        ?>
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