<?php

$host =  "localhost";
$user = "root";
$password = "";
$database = "banco_base";

$conn = new mysqli($host, $user, $password, $database);

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . "?") . "/";
function getCurrentDate() {
    date_default_timezone_set('America/Sao_Paulo'); // Configura o fuso horário para Brasília (BRT)
    return date("Y-m-d");
}

function getCurrentTime() {
    date_default_timezone_set('America/Sao_Paulo'); // Configura o fuso horário para Brasília (BRT)

    return date("H:i:s");
}

$GLOBALS['currentDate'] = getCurrentDate();
$GLOBALS['currentTime'] = getCurrentTime();
// $currentDate = getCurrentDate();
// $currentTime = getCurrentTime();

function generateNumKey($len, $min, $max){
    $sequence = array();

    for($i=0; $i < $len; $i++){
        $sequence[] = rand($min, $max);

    }
    return $sequence;
}

$numbers = generateNumKey(16, 0, 9);

$chave_recuperacao = implode($numbers);

function generateRandomLetterHash($length = 20) {
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lettersLength = strlen($letters);
    $hash = '';

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = rand(0, $lettersLength - 1);
        $hash .= $letters[$randomIndex];
    }

    return $hash;
}

$key_user = generateRandomLetterHash(20);

$dataAtual = $GLOBALS['currentDate'];
$horaAtual = $GLOBALS['currentTime'];


$pdo = new PDO("mysql:dbname=$database;host=$host;charset=utf8", "$user", "$password");



$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . "?") . "/";

define('MYSQL_CONFIG', [
    'host' => 'localhost',
    'database' =>'banco_base',
    'username' => 'root',
    'password' => '',
]);