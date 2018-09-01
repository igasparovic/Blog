<?php include_once "Config.php";?>
<?php if(isset($_SESSION["username"])){ $divid = "main";} else{$divid = "index";}?>
<!DOCTYPE HTML>
<html>
<?php include_once "Include/Head.php"?>
	<body class="is-preload">
		<!-- Wrapper -->
			<div id="wrapper">
				<!-- Header -->
					<?php include_once "Include/Header.php"?>
				<!-- Main -->
					<div id="<?php echo $divid ?>">
						<!-- Post -->
							<div style="text-align: center;"><article class="post">
								<header>
									<div class="title">
										<h2><a href="#">Tree</a></h2>
                                        <p><i>"As a tree has branches and roots, so does a sentence have thoughts rooted in and out of our experience."</i></p>
									</div>
								</header>
								<a href="#" class="image featured"><img src="Include/images/tree.jpg" alt="" /></a>
								<p>Stop "treeing" about and start your blog, so your thoughts can live in someone else's mind!</p>
								<footer>
									<ul class="actions">
										<li><a href="#" class="button large">Continue Reading</a></li>
									</ul>
									<ul class="stats">
										<li><a href="#" class="icon fa-heart">28</a></li>
										<li><a href="#" class="icon fa-comment">128</a></li>
									</ul>
								</footer>
							</article></div>
					</div>
				<!-- Sidebar -->
                <?php if(isset($_SESSION["username"])){include_once "Include/Sidebar.php";} ?>
			</div>
		<!-- Scripts -->
        <?php include_once "Include/Scripts.php"?>
	</body>
</html>