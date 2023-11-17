<?php

use Midspace\Database;
require_once('config.php');
require_once("Database.php");

$user = $_GET['user'];
$id_post = $_GET['id'];

$query = new Database(MYSQL_CONFIG);
$query->execute_non_query("INSERT INTO likes (post_id, user_id) VALUES (:id, :user)", ['id' => $id_post, 'user' => $user]);

?>

