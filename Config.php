<?php

session_start();

$sourceAPP = "/Blog/";
$nameAPP = "Bloggerion";
$appID = "BlogAPP";

$host="localhost";
$dbname="blog";
$dbuser="Poofpoo";
$dbpass="root";
$dev=true;

try{
    $connection = new PDO("mysql:host=" . $host .";dbname=" . $dbname . ";charset=utf8" , $dbuser ,$dbpass );
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    if($e->getCode()){
        echo ("Error number: " . $e->getCode());
    }
}


