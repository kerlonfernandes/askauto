<?php


use Midspace\Database;
require_once('config.php');
require_once("Database.php");


$query = new Database(MYSQL_CONFIG);
$postagem = $_GET['post'];
$usuario = $_GET['user'];


$query->execute_non_query("DELETE FROM respostas WHERE id_postagem = :id", ['id' => $postagem]);
$query->execute_non_query("DELETE FROM postagens WHERE id = :id AND id_usuario = :id_usuario", ['id' => $postagem, "id_usuario" => $usuario]);

header("location: ../../home.php");


?>