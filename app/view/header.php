<?php

session_status();
$user_id = $_SESSION['id_user'];


?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AskAuto - Faça sua pergunta Automotiva!</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="./public/css/home.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="./public/css/replies.css">
  <style>
    .img-profile-user {
      width: 48px;
      height: 48px;
    }
  </style>
  <link rel="stylesheet" href="../public/css/postagem.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>


  <!-- sidebar starts -->
  <div class="sidebar" style="margin-left: 100px;">
    <a href="<?= $BASE_URL ?>"><img src="<?= $BASE_URL ?>./public/images/logo.jpg" alt="logo-ask-auto"></a>
    <div class="sidebarOption active">
      <span class="material-icons"> home </span>
      <a href="<?= $BASE_URL ?>" class="home_h2">
        <h2>Início</h2>
      </a>

    </div>

    <div class="sidebarOption" id="search">
      <span class="material-icons"> search </span>
      <h2>Perguntas</h2>
    </div>

    <div class="sidebarOption">

        <span class="material-icons"> perm_identity </span>
        <a href="./app/usuario.php?id=<?= $user_id ?>" style="text-decoration: none;">

        <h2>Meu Perfil</h2>
        </a>
    </div>
  </div>
  <!-- sidebar ends -->

  <!-- feed starts -->
  <div class="feed">
    <div class="feed__header">
      <h2>Início</h2>
    </div>

    <script src="<?= $BASE_URL ?>/public/js/scripts.js" async></script>