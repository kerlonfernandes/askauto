<?php
session_start();


include_once('../header.php');
include_once('./controller/functions_db.php');
include_once('./controller/config.php');
include_once('./view/header_post.php');

$user_id = $_GET['user'];
$id_post = $_GET['post'];
$respostas = respostas($_GET['post'] ?? null);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $resposta = $_POST['resposta'];
    if (isset($resposta)) {

        responder($_GET['post'], $_SESSION['id_user'], $resposta);
        header('Location: ' . $_SERVER['REQUEST_URI']);
    }
}
?>

<html>

<head>
    <style>
        .img-profile-user {
            width: 48px;
            height: 48px;


        }

        #loader {
            text-align: center;
            /* Alinhar horizontalmente */
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <link rel="stylesheet" href="../public/css/respostas.css">
</head>

<body>

    <?php

    $posts =  exibePostagem($conn, $id_post);


    if (isset($posts)) {
        $postagem = $posts[0]['postagem'];
        $nome_usuario = $posts[0]['nome_usuario'];
    } else {
        $postagem = 'Post não encontrado';
    }


    ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="post__avatar">
                            <img class="img-profile-user" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
                            <span class="card-text">
                                <?php if (isset($nome_usuario)) {
                                    echo '<span class="username-post">' . $nome_usuario . '</span>';
                                } else {
                                    echo 'Usuário não encontrado';
                                } ?></span>
                        </div>
                    </div>

                    <?php if (isset($postagem)) {

                        $embeddedVideo = embedYouTubeVideo($postagem);
                        if (isset($embeddedVideo)) {
                            echo " <div class='card-body text-center'> 
                                    <span>$postagem</span>
                                    <span class='card-text'> $embeddedVideo</span>
                                    </div>";
                        } else {
                            echo " <div class='card-body'>

                                    <span>$postagem</span>
                                
                                </div>    
                                ";
                        }
                    } else {
                        echo "Post não existente";
                    } ?>


                    </span>

                    <div class="card-footer">
                        <span><?= $posts[0]['data_postagem'] ?> <?= $posts[0]['hora'] ?></span>
                    </div>
                </div>

                <div class="card-footer">




                    <div class="card">
                        <div class="box">


                            <div class="card-body">
                                <form method="post" class="text-ask">
                                    <div class="tweetbox__input">
                                        <img src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
                                        <input type="text" placeholder="Responda este Post" id="message-text" name="resposta" maxlength="360" />
                                    </div>


                            </div>
                        </div>


                        <div class="card-footer">
                            <button type="submit" class="tweetBox__tweetButton">Enviar</button>
                        </div>
                        </form>
                    </div>


                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <span class="h3 text-center mt-3 p-3">Respostas</span>
                        <div id="loader" role="status">
                            <div id="spinner-container" style=''><img src="<?= $BASE_URL ?>../public/images/spinner.gif" alt="logo-ask-auto" width="24px"></div>
                            <div class="postagens"></div>
                        </div>
                    </div>
                    <div class="respostas"></div>

                </div>


            </div>

        </div>




    </div>

    </div>
    </div>
    </div>


    </div>

    </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            function consultarPostagem() {
                // Carregar o spinner no container
                $("#spinner-container").show();

                // Obter os parâmetros do PHP
                var user_id = <?php echo json_encode($user_id); ?>;
                var post_id = <?php echo json_encode($id_post); ?>;

                // Criar um objeto com os parâmetros
                var params = {
                    user: user_id,
                    post: post_id
                };

                $.ajax({
                    url: "replies-consulta.php",
                    method: "GET",
                    data: params,
                    success: function(data) {
                        $(".respostas").html(data);
                    },
                    error: function() {
                        console.error("Erro na requisição Ajax");
                    },
                    complete: function() {
                        $("#spinner-container").hide();
                    }
                });
            }

            // Carregar os resultados iniciais
            consultarPostagem();
        });
    </script>

</body>




</html>