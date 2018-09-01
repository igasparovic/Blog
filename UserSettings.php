<?php include_once "Config.php";
if(isset($_SESSION["username"])){
    $querry = $connection->prepare("SELECT * FROM users WHERE username=:username");
    $querry->execute(array('username' => $_SESSION["username"]));
    $user=$querry->fetch(PDO::FETCH_OBJ);
    }else { header("location: index.php");}
?>
<!DOCTYPE HTML>
<html>
    <?php include_once "Include/Head.php"?>


    <body class="is-preload">
            <!-- Wrapper -->
                <div id="wrapper">
                    <!-- Header -->
                        <?php include_once "Include/Header.php"?>
                    <!-- Main -->
                    <div id="main">
                        <!-- Post -->
                        <article class="post">
                            <form  method="post" action = "UserDataEntry/UserSettingsUpdate.php" enctype="multipart/form-data">
                                <h3><label>Account</label></h3><br>
                                <?php  if(isset($_SESSION["error"])){
                                    echo "<label>".($_SESSION["error"])."</label>";
                                    $_SESSION["error"] = null; } ?>
                                <label>E-mail: <input type="email" name="email" value="<?php echo ($user->email)?>"><br></label>
                                <label>Quote: <input type="text" name="quote"  value="<?php echo ($user->quote)?>" ><br></label>
                                <p>
                                    <input type="file" name="file" id="file" class="inputfile" />
                                    <label for = "file" id = "filelabel" class="button icon fa-upload"><span>Avatar</span></label><i> &nbsp; only .jpg format allowed (500KB,4:3)</i>

                                </p>

                                <h3><label>General information</label></h3><br>

                                <label>
                                        First name: <input type="text"  name="firstname"  maxlength="20"  value="<?php echo ($user->firstname)?>">
                                        Last name: <input type="text"  name="lastname" maxlength="20"  value="<?php echo ($user->lastname)?>" >
                                </label>
                                <label>
                                        Country: <input type="text"  name="country"  value="<?php echo ($user->country)?>">
                                        State: <input type="text"  name="state"   value="<?php echo ($user->state)?>">
                                        City: <input type="text"  name="city"  value="<?php echo ($user->city)?>"><br>
                                </label>

                                <h4>Gender:</h4><br>

                                <p>
                                    <input type="radio" id="demo-priority-low" name="gender" value="Male" <?php if($user->gender == "Male"){echo "checked";}?> >
                                    <label for="demo-priority-low">Male</label>
                                    <input type="radio" id="demo-priority-normal" name="gender" value="Female" <?php if($user->gender == "Female"){echo "checked";}?> >
                                    <label for="demo-priority-normal">Female</label>
                                </p>
                                <br><br>
                                <input type="submit" name="save" value="Save"/><br><br>
                            </form>
                            <form method = "post" action = "UserDataEntry/UserSettingsUpdate.php">
                                <h4>Change password:</h4><br>
                                <label>
                                    Current password <input type="password"  name="currpassword" />
                                    New password: <input type="password"  name="newpassword" maxlength="20" minlength="8"  >
                                    Repeat password: <input type="password"  name="newreppassword" /><br>
                                </label>
                                <input type="submit" name="changepw" value="change"/><br><br>

                            </form>
                        </article>
                    </div>
                    <!-- Sidebar -->
                    <?php include_once "Include/Sidebar.php"?>
                </div>
                <!-- Scripts -->
                <?php include_once "Include/Scripts.php"?>
    </body>
</html>
