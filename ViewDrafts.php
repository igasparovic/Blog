<?php include_once "Config.php";
if(isset($_SESSION["username"]) or isset($_SESSION["visitor"])){
    $blogquerry = $connection->prepare("SELECT * FROM blogposts WHERE username=:username AND draft=:draft");
    $blogquerry->execute(array('username' => $_SESSION["username"], 'draft' => true));
    $posts = $blogquerry->fetchAll(PDO::FETCH_ASSOC);
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
        <?php foreach($posts as $post) {
            foreach ($post as $key => $value) {
                if ($key == 'title'){
                    $title = $value;
                }
                if ($key == 'summary'){
                    $summary = $value;
                }
                if($key == 'headpicture'){
                    $headpicture = $value;
                }
                if($key == 'postid'){
                    $postid = $value;
                }
                if($key == 'commentNum'){
                    $commentNum = $value;
                }
                if($key == 'username'){
                    $username = $value;
                }
                if($key == 'timestamp'){
                    $timestamp = $value;
                }
            }?>
            <div>
                <article class="post">
                    <header>
                        <div class="title">
                            <h2><a href="#"><?php echo $title; ?></a></h2>
                            <p><?php echo $summary; ?></p>
                        </div>
                        <div class="meta">
                            <time class="published" datetime="2015-11-01"><?php echo $timestamp ?></time>
                            <a href="#" class="author"><span class="name"><?php echo $username ?></span><img src="userfiles/<?php echo $username;?>/avatar.jpg" alt="" /></a>
                        </div>
                    </header>
                    <a href="ViewPost.php?id=<?php echo $postid; ?>" class="image featured"><img src="<?php echo $headpicture; ?>" alt="" /></a>
                    <footer>
                        <ul class="actions">
                            <li><a href="ViewPost.php?id=<?php echo $postid; ?>" class="button large">Read</a></li>
                            <?php if(isset($_SESSION["username"]) AND $_SESSION["username"] == $username){ ?>
                                <li><a href="CreateBlogPost.php?id=<?php echo $postid; ?>" class="button large">Edit</a></li>
                            <?php } ?>
                        </ul>
                        <ul class="stats">
                            <li><a href="#" class="icon fa-comment"><?php echo $commentNum ?></a></li>
                        </ul>
                    </footer>
                </article>
            </div>
            <?php

        }?>
    </div>
    <!-- Sidebar -->
    <?php include_once "Include/Sidebar.php"?>
</div>
<!-- Scripts -->
<?php include_once "Include/Scripts.php"?>
</body>
</html>