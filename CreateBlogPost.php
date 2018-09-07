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
                    <form method="post" action="UserDataEntry/SaveBlogPost.php" enctype="multipart/form-data" >
                        <label>Title: <br><input type="text" name="title" minlength="3" maxlength="15" required></label>
                        <label>Summary: <br><input type="text" name="Summary" maxlength="30"></label>
                        <p>
                            <input type="file" name="file" id="file" class="inputfile" />
                            <label for = "file" id = "filelabel" class="button icon fa-upload"><span>Head picture</span></label><i> &nbsp; only .jpg format allowed</i>
                        </p>
                        <label>Blog:</label>
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


