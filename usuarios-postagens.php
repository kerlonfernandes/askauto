<?php

require_once("./app/controller/functions_db.php");
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'banco_base';

$postagens = array();

if (isset($_GET['postagem'])) {
  $postagem = $_GET['postagem'];
  $user_id = $_SESSION['id_user'];
  $conn = new mysqli($host, $user, $pass, $db);

  $query = "SELECT p.postagem, p.id AS postagem_id, u.id AS user_id, u.nome_usuario, u.id, p.hora, p.data_postagem
    FROM postagens AS p
    JOIN usuarios AS u ON p.id_usuario = u.id
    WHERE p.postagem LIKE '%$postagem%' OR nome_usuario LIKE '%$postagem%'
    ORDER BY p.id DESC;
    ";
  $result = $conn->query($query);

  if ($result === false) {
    echo "Erro na consulta SQL: " . $conn->error;
  }

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $postagens[] = $row; 
    }
  }
}

?>

<html>
<?php if ($postagens) : ?>
  <?php foreach ($postagens as $post) : ?>
    <div class="card m-3 p-3 w-100">
      <div class="post">
        <div class="post__avatar">
          <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
          <span><a href="./app/usuario.php?id=<?= $post['id'] ?>" class="username-post">@<?= $post['nome_usuario'] ?></a> <?php if($post['user_id'] == $_SESSION['id_user']) echo "<span><strong>- Você</strong></span>" ?></span>
          <hr>
        </div>

        <!-- Corpo do post -->
        <div class="post__body ">

          <div class="post__header"></div>

          <!-- Conteúdo do post -->
          <div class="post__headerDescription">
            <div class="card lg-8 mt-10">
              <div class="profile-block">
                <div class="grid text-start">
                  <div class="g-col-6">


                  </div>
                </div>
              </div>
              <div class="card-body">
                <span>
                  <?php

                  $embeddedVideo = embedYouTubeVideo($post['postagem']);
                  if (isset($embeddedVideo)) {
                    echo $post['postagem'];
                    echo $embeddedVideo;
                  } elseif (isset($post['postagem'])) {
                    echo $post['postagem'];
                  }
                  ?>

                </span>



                <div class="card-footer">
                  <span style="margin-left:-10px;"><?= $post['data_postagem'] ?></span>
                </div>
              </div>
            </div>
            <?= $post['hora'] ?>

            <!-- Rodapé do post -->
            <div class="post__footer">
             
              <?php require("./up.php") ?>



              <hr>


            </div>
            <div class="options" style="position: absolute; top: 0; right: 0;">

                <div class="dropdown-center">
                  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                      <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                    </svg> </button>
                  <ul class="dropdown-menu">
                    <?php if($user_id == $post['id']) :?>
                    <li><a class="dropdown-item" href="./app/helpers/deleta-post.php?post=<?= $post['postagem_id'] ?>&user=<?= $post['id'] ?>">Deletar Postagem</a></li>
                    <?php endif; ?>
                    <li><a class="dropdown-item" href="">Enviar</a></li>
                  </ul>
                </div>
              </div>
          </div>
        </div>
      </div>
      <button class="post__show-hide-button"><a href="./app/postagem.php?post=<?= $post['postagem_id'] ?>&user=<?= $post['id'] ?>" class="respostas-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-reply" viewBox="0 0 16 16">
  <path d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z"/>
</svg></a></button>

    </div>
  <?php endforeach ?>
<?php else : ?>
  <span style="margin:250px;">Nenhum Resultado encontrado</span>
<?php endif; ?>

</html>