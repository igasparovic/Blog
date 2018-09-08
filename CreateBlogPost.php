<?php include_once "Config.php";
if(isset($_SESSION["username"])){
    if(isset($_SESSION["draft"])){
        $draftQuery = $connection->prepare("SELECT * FROM blogposts WHERE postid=:postid");
        $draftQuery->execute(array('postid' => $_SESSION{"draft"}));
        $draft = $draftQuery->fetch(PDO::FETCH_OBJ);
    }
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
                    <label><?php if(isset($_SESSION["error"])){echo( $_SESSION["error"]);}?></label>
                    <form method="post" action="UserDataEntry/SaveBlogPost.php" enctype="multipart/form-data" >
                        <label>Title: <br><input type="text" name="title" minlength="3" maxlength="15" value="<?php if(isset($_SESSION["draft"])){print_r($draft->title);}?>" required></label>
                        <label>Summary: <br><input type="text" name="summary" maxlength="30" value="<?php if(isset($_SESSION["draft"])){print_r($draft->summary);}?>"></label>
                        <p>
                            <input type="file" name="file" id="file" class="inputfile" />
                            <label for = "file" id = "filelabel" class="button icon fa-upload"><span>Head picture</span></label><i> &nbsp; only .jpg format allowed</i>
                        </p>
                        <label>Blog:</label>
                        <textarea name="content" id="editor" required>
                            <?php if(isset($_SESSION["draft"])){print_r($draft->post);}?>
                        </textarea>
                        <input type="submit" name="SavePost" id="SavePost" value="Save">
                        <input type="submit" name="SaveDraft" id="SaveDraft" value="Draft">
                    </form>
            </div>
        </div>
        <script>
            var editor = CKEDITOR.replace( 'editor' );
            CKFinder.setupCKEditor( editor );
        </script>
            <!-- Scripts -->
            <?php include_once "Include/Scripts.php"?>
    </body>
</html>


