<?php include_once "Config.php";
if(isset($_SESSION["username"]) AND isset($_SESSION["draft"])){
    $postQuery = $connection->prepare("SELECT * FROM blogposts WHERE postid=:postid");
    $postQuery->execute(array('postid' => $_SESSION["draft"]));
    $post = $postQuery->fetch(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE HTML>
<html>
<?php include_once "Include/Head.php"?>
    <!-- Wrapper -->
    <div id="wrapper">
        <body class="is-preload">
            <div id="index">
                <article class="post">
                    <header>
                        <div class="title">
                            <h2><a href="#"><?php echo $post->title; ?></a></h2>
                            <p><?php echo $post->summary; ?></p>
                        </div>
                    </header>
                    <a href="#" class="image featured"><img src="<?php echo $post->headpicture; ?>" alt="" /></a>
                    <footer>
                        <ul class="actions">
                            <li><a href="#" class="button large">Read</a></li>
                        </ul>
                        <ul class="stats">
                            <li><a href="#" class="icon fa-comment"><?php echo $post->commentNum ?></a></li>
                        </ul>
                    </footer>
                </article>
            </div>
    </div>
    <!-- Wrapper -->
        <div id="wrapper">
            <!-- Header -->
            <?php include_once "Include/Header.php"?>
            <!-- Main -->

            <div id="main">
                    <article class="post">
                        <header>
                            <div class="title">
                                <h2><a href="#"><?php echo $post->title; ?></a></h2>
                                <p><?php echo $post->summary; ?></p>
                            </div>
                            <div class="meta">
                                <time class="published" datetime="2015-11-01"><?php echo $post->timestamp ?></time>
                                <a href="#" class="author"><span class="name"><?php echo $post->username ?></span><img src="userfiles/<?php echo $_SESSION["username"];?>/avatar.jpg" alt="" /></a>
                            </div>
                        </header>
                        <p><?php echo ($post->post)?></p>
                        <footer>
                            <ul class="stats">
                                <li><a href="#" class="icon fa-comment"><?php echo $post->commentNum ?></a></li>
                            </ul>
                        </footer>
                    </article>
                <article class="post">
                    <a href="CreateBlogPost.php" class="button icon"><span class="name">Continue Editing</span></a>
                </article>
            </div>
        </div>
    <!-- Scripts -->
    <?php include_once "Include/Scripts.php"?>
    </body>
</html>