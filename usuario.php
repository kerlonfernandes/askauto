<?php

session_start();
require_once('./app/controller/config.php');
require_once('./app/controller/functions_db.php');

$user = $_GET['user'];

$dados = perfis($conn, $user);
print_r($dados);

