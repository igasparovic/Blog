<?php include_once "Config.php";
if(isset($_SESSION["username"]) or isset($_SESSION["visitor"])){
    $postQuery = $connection->prepare("SELECT * FROM blogposts WHERE postid=:postid");
    $postQuery->execute(array('postid' => $_GET["id"]));
    $post = $postQuery->fetch(PDO::FETCH_OBJ);
}
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
                    <div style="text-align: center;">
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
                            <div style="text-align: center;"><p><?php echo ($post->post)?></p></div>
                            <footer>
                                <ul class="stats">
                                    <li><a href="#" class="icon fa-heart">28</a></li>
                                    <li><a href="#" class="icon fa-comment">128</a></li>
                                </ul>
                            </footer>
                        </article>
                    </div>

                </div>
            </div>
        <!-- Sidebar -->
        <!-- Scripts -->
        <?php include_once "Include/Scripts.php"?>
        </body>
</html>