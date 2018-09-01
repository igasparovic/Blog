<?php include_once "Config.php";
if(isset($_SESSION["username"])){
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

    <!-- Sidebar -->
    <?php include_once "Include/Sidebar.php"?>
</div>
<!-- Scripts -->
<?php include_once "Include/Scripts.php"?>
</body>
</html>
