<?php
$host="localhost";
$db_user="root";
$db_password="";
$db="redsocial";

$connect = mysqli_connect($host,$db_user,$db_password);
if(!$connect)
    echo("No se conecto la base de datos");
?>