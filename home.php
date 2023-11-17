<?php
session_start();
require_once('./app/controller/config.php');
require_once('./app/controller/functions_db.php');
require_once('./app/view/header.php');


$user = $_SESSION['user_name'];
$user_id = $_SESSION['id_user'];


if (!isset($user)) {
  header('location:login.php');
}
require_once('./main.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $pergunta = nl2br(htmlspecialchars($_POST['ask']));
  if (!empty($pergunta)) {

    $string = $pergunta;
    $stringSemEspacos = str_replace(' ', '', $string);
    $quantidadeLetras = strlen($stringSemEspacos);

    if ($quantidadeLetras > 360) {
      echo "Quantidade de caracteres Excedida!";
      echo "<script>
    
      
    
    </script>";
    } else {
      postagemEnviar($conn, $user_id, $pergunta);
      // Redirecionar para evitar reenvio do formulário
      header('Location: ' . $_SERVER['REQUEST_URI']);
      exit;
    }
  }
}


?>


<!-- tweetbox starts -->
<div class="tweetBox">
  <form action="" method="post" name="ask" class="text-ask">
    <div class="tweetbox__input">
      <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
      <input type="area" placeholder="Qual é a sua dúvida?" id="message-text" name="ask" maxlength="360" />
    </div>
    <button type="submit" class="tweetBox__tweetButton">Enviar</button>
  </form>

  <div class="char-count"></div>
</div>
<!-- tweetbox ends -->

<div id="loader" role="status">
  <div id="spinner-container" style=''><img src="<?= $BASE_URL ?>./public/images/spinner.gif" alt="logo-ask-auto" width="24px"></div>

</div>
<div class="postagens" style="margin-left:100px;margin-right:100px;"></div>
</div>
<!-- feed ends -->

<!-- widgets starts -->
<div class="widgets">
  <div class="widgets__input">
    <span class="material-icons widgets__searchIcon"> search </span>
    <input type="text" placeholder="Encontre sua dúvida" name="pesquisar-postagem" id="pesquisar-postagem" />
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

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const textArea = document.querySelector('#message-text');
    const charCountSpan = document.querySelector('.char-count');

    textArea.addEventListener('input', () => {
      const maxLength = parseInt(textArea.getAttribute('maxlength'));
      const currentLength = textArea.value.length;

      charCountSpan.textContent = currentLength + ' / ' + maxLength + ' caracteres';
    });

    textArea.addEventListener('keydown', (event) => {
      const maxLength = parseInt(textArea.getAttribute('maxlength'));
      const currentLength = textArea.value.length;

      if (currentLength >= maxLength && event.key !== 'Backspace') {
        event.preventDefault(); // Impede a digitação de mais caracteres
        charCountSpan.classList = 'red'
        charCountSpan.textContent = currentLength + ' / ' + maxLength + ' caracteres | Limite de caracteres Atingido!';
      } else {
        charCountSpan.textContent = currentLength + ' / ' + maxLength + ' caracteres';
        charCountSpan.classList = ''
      }
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script async src="./app/ajax/posts.js"></script>
<script src="./app/ajax/like.js"></script>

<?php

require_once('./app/view/footer.php');

?>