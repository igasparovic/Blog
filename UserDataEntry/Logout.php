<?php
include_once "../Config.php";

if(isset($_SESSION["username"])){
    $_SESSION["username"] = null;
    header("location: ../index.php");
}
if(isset($_SESSION["admin"])){
    $_SESSION["admin"] = null;
}