<?php include_once "Config.php";
if(isset($_SESSION["username"])){ ;
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
                    <form method="post" action="UserDataEntry/SaveBlogPost.php">
                        <textarea name="content" id="editor">
                        </textarea>
                        <input type="submit" name="SavePost" id="SavePost" value="Save">
                        <input type="submit" name="SaveDraft" id="SaveDraft" value="Draft">
                    </form>
            </div>
        </div>
            <!-- Scripts -->
            <?php include_once "Include/Scripts.php"?>
    </body>
</html>


