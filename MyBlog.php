<?php include_once "Config.php";
if(isset($_SESSION["username"])){
    $blogquerry = $connection->prepare("SELECT * FROM blogposts WHERE username=:username AND draft=:draft");
    $blogquerry->execute(array('username' => $_SESSION["username"], 'draft' => false));
    $posts = $blogquerry->fetchAll(PDO::FETCH_ASSOC);
    $count = $blogquerry->rowCount();
    $i=0;
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
                        <?php while($i<$count) {
                        foreach ($posts[$i] as $key => $value) {
                            if ($key == 'title'){
                                $title = $value;
                            }
                            if ($key == 'summary'){
                                $summary = $value;
                            }
                            if($key == 'headpicture'){
                                $headpicture = $value;
                            }
                        }?>
                            <div style="text-align: center;">
                                <article class="post">
                                    <header>
                                        <div class="title">
                                            <h2><a href="#"><?php echo $title; ?></a></h2>
                                            <p><?php echo $summary; ?></p>
                                        </div>
                                    </header>
                                    <a href="#" class="image featured"><img src="<?php echo $headpicture; ?>" alt="" /></a>
                                    <footer>
                                        <ul class="actions">
                                            <li><a href="#" class="button large">Continue Reading</a></li>
                                        </ul>
                                        <ul class="stats">
                                            <li><a href="#" class="icon fa-heart">28</a></li>
                                            <li><a href="#" class="icon fa-comment">128</a></li>
                                        </ul>
                                    </footer>
                                </article>
                            </div>
                        <?php
                                $i++;
                            }?>
                    </div>
                <!-- Sidebar -->
                <?php include_once "Include/Sidebar.php"?>
            </div>
        <!-- Scripts -->
        <?php include_once "Include/Scripts.php"?>
    </body>
</html>