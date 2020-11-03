<?php

$host = 'localhost';
$dbname = 'sisrecsenha';
$user = 'root';
$password = '';
try{
    $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    echo "<h2 class='alert alert-danger'>Erro ao conectar com banco de dados!<br>Mensagem: -></h2>".$e->getMessage();
    die();
}

?>