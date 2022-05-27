<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=crs;charset=utf8", "root", "",array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8 COLLATE utf8_turkish_ci;",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING 
    ));
    //$db->exec("set names utf8");

} catch (PDOException $e) {
    print $e->getMessage();
}
