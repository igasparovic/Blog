
<meta charset="utf-8" />
<header id="header">
    <h1><a href="index.php">Bloggerion</a></h1>
    <nav class="links">
        <ul>
            <li><a href="#">Newsfeed</a></li>
            <li><a href="#">Showcase</a></li>
            <li><a href="#">Features</a></li>
            <li><a href="#">About</a></li>
            <li><a href="MyBlog.php">My Blog</a></li>
        </ul>
    </nav>
    <nav class="main">
        <ul>
            <li class="search">
                <a class="fa-search" href="#search">Search</a>
                <form id="search" method="get" action="#">
                    <input type="text" name="query" placeholder="Search" />
                </form>
            </li>
            <li class="menu">
                <a class="fa-bars" href="#menu">Menu</a>
            </li>
        </ul>
    </nav>
</header>

<!-- Menu -->
<section id="menu">
    <?php if(isset($_SESSION["username"])){
        ?>
        <section>
            <ul class="posts">
                <li>
                    <article>
                        <header>
                            <div style="text-align: center;"><h1> <?php echo $_SESSION["username"]; ?> </h1></div>
                        </header>
                    </article>
                </li>
            </ul>
        </section>
                <!-- Links -->
                <section>
                    <ul class="links">
                        <li>
                            <a href="CreateBlogPost.php">
                                <h3>New Blog</h3>
                            </a>
                        </li>
                        <li>
                            <a href="Profile.php">
                                <h3>Profile</h3>
                            </a>
                        </li>
                        <li>
                            <a href="UserSettings.php">
                                <h3>Settings</h3>
                            </a>
                        </li>

                        <?php if(isset($_SESSION["admin"])){ ?>
                        <li>
                            <a href="#">
                                <h3>Admin Panel</h3>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </section>
    <?php
        }
    ?>
    <!-- Actions -->
    <?php if(!isset($_SESSION["username"])) {
        ?>
        <section>
            <ul class="actions stacked">
                <li><a href="Registration.php" class="button large fit">Sign Up</a></li>
                <li><a href="Login.php" class="button large fit">Log In</a></li>
            </ul>
        </section>
    <?php } else{
        ?>
        <ul class="actions stacked">
            <li><a href="UserDataEntry/Logout.php" class="button large fit">Log Out</a></li>
        </ul>
    <?php
    }?>
</section>