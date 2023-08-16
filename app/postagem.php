<?php
session_start();

include_once('../header.php');
include_once('./controller/functions_db.php');
include_once('./controller/config.php');

$id_post = $_GET['id'];

?>

<html>

<head>
    <style>
        .img-profile-user {
            width: 48px;
            height: 48px;
        }
    </style>
</head>

<body>

    <?php

    $posts =  exibePostagem($conn, $id_post);


    if (isset($posts)) {
        $postagem = $posts[0]['postagem'];
        $nome_usuario = $posts[0]['nome_usuario'];
        print_r($posts);
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
                            <span class="card-text"><?php if (isset($nome_usuario)) {
                                                        echo $nome_usuario;
                                                    } else {
                                                        echo 'Usuário não encontrado';
                                                    } ?></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <span class="card-text"><?php if (isset($postagem)) {
                                                    echo $postagem;
                                                    $embeddedVideo = embedYouTubeVideo($postagem);
                                                    echo $embeddedVideo;
                                                } else {
                                                    echo "Post não existente";
                                                } ?>
                            <span>
                          

                            </span>

                        </span>
                    </div>
                    <div class="card-footer">
                        hora: 12:12
                    </div>
                </div>

                <!-- Repita este bloco de card para cada postagem no feed -->

            </div>
        </div>
    </div>


</body>




</html>