<?php 
$dsn = 'mysql:host=localhost;dbname=bdda';
$user = 'root';
$pass = 'mysql10';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
// try{
$conn = new PDO($dsn,$user,$pass,$option);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// }catch(PDOException $e){
//     echo 'Failed To Connct'.$e->getMessage();
// }
?>