<?php
require_once('./app/controller/config.php');
require_once('./app/controller/functions_db.php');


session_start();
$user = $_SESSION['user_name'];
$user_id = $_SESSION['id_user'];


if (!isset($user)) {
  header('location:login.php');
}
require_once('./main.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $pergunta = $_POST['ask'];
  if (!empty($pergunta)) {
     postagemEnviar($conn, $user_id, $pergunta);
    // Redirecionar para evitar reenvio do formulário
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit;
  }
}
$posts = exibePostagens($conn);

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
</head>

<body>
  <!-- sidebar starts -->
  <div class="sidebar">
    <i class="fa fa-car fa-2x" style="margin-left: 20px; margin-right: 5px;"><span style="font-family: 'Work Sans', sans-serif;
">AskAuto</span></i>
    <div class="sidebarOption active">
      <span class="material-icons"> home </span>
      <h2>Início</h2>
    </div>

    <div class="sidebarOption">
      <span class="material-icons"> search </span>
      <h2>Perguntas</h2>
    </div>

    <!-- <div class="sidebarOption">
        <span class="material-icons"> notifications_none </span>
        <h2>Notifications</h2>
      </div> -->

    <!-- <div class="sidebarOption">
        <span class="material-icons"> mail_outline </span>
        <h2>Messages</h2>
      </div> -->

    <!-- <div class="sidebarOption">
        <span class="material-icons"> bookmark_border </span>
        <h2>Bookmarks</h2>
      </div> -->

    <!-- <div class="sidebarOption">
        <span class="material-icons"> list_alt </span>
        <h2>Lists</h2>
      </div> -->

    <div class="sidebarOption">
      <span class="material-icons"> perm_identity </span>
      <h2>Meu Perfil</h2>
    </div>

    <!-- <div class="sidebarOption">
      <span class="material-icons"> more_horiz </span>
      <h2>More</h2>
    </div> -->
    <div class=""></div>
  </div>
  <!-- sidebar ends -->

  <!-- feed starts -->
  <div class="feed">
    <div class="feed__header">
      <h2>Início</h2>
    </div>

    <!-- tweetbox starts -->
    <div class="tweetBox">
      <form action="" method="post" name="ask">
        <div class="tweetbox__input">
          <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
          <input type="text" placeholder="Qual é a sua dúvida?" id="message-text" name="ask" />
        </div>
        <button type="submit" class="tweetBox__tweetButton">Enviar</button>
      </form>
    </div>
    <!-- tweetbox ends -->

    <?php foreach ($posts as $post) : ?>
        <div class="post">
          <!-- Avatar do usuário -->
          <div class="post__avatar">
         
            <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
            <span><a href="">@<?= $post['nome_usuario'] ?></a></span>
          </div>

          <!-- Corpo do post -->
          <div class="post__body">
          <span style="margin-bottom: 5px; border-bottom: 1px solid black;">
                
                  <!-- <span class="post__headerSpecial"
                   ><span class="material-icons post__badge"> verified </span>
                </span  -->
                
          </span>
            <div class="post__header">
           
            </div>

            <!-- Conteúdo do post -->
            <div class="post__headerDescription">
            <span><?= $post['postagem'] ?></span>
            </div>
            <?= $post['hora']?>
            <!-- Rodapé do post -->
            <div class="post__footer">
              <!-- Botão para mostrar/ocultar respostas -->
              <button class="post__show-hide-button">Mostrar Respostas</button>
              
             
              <div class="post__replies" style="display: none;">
              <hr >
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>


</div>
<!-- feed ends -->

<!-- widgets starts -->
<div class="widgets">
  <div class="widgets__input">
    <span class="material-icons widgets__searchIcon"> search </span>
    <input type="text" placeholder="Encontre sua dúvida" />
  </div>

  <div class="widgets__widgetContainer">
    <h2>Perguntas Mais Curtidas</h2>
    <blockquote class="twitter-tweet">
      <p lang="en" dir="ltr">
        Tags
        <a href="">#automotiva</a>
        <a href="">#duvidas</a>
        <a href="">#pergunta</a>
        <a href=""></a>
      </p>
      &mdash; 
      <a href="">Hoje</a>
    </blockquote>
    <script async src="" charset="utf-8"></script>
    <script src="./public/js/replies.js"></script>
  </div>
</div>
<!-- widgets ends -->
</body>

</html>

