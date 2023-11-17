<?php

session_start();

use Midspace\Database;

include_once('../header.php');
include_once('./controller/functions_db.php');
include_once('./controller/config.php');
include_once('./view/header_post.php');

if(empty($_GET['id'])) {

    $user = $_SESSION['id_user'];
}
else {

    $user = $_GET['id'];

}

if(empty($_SESSION['id_user'])) header("Location: ../home.php");



$user = $_GET['id'];

$query = new Database(MYSQL_CONFIG);

$res = $query->execute_query(
    "SELECT usuarios.*,postagens.*, postagens.id AS postagem_id FROM usuarios LEFT JOIN postagens ON usuarios.id = postagens.id_usuario WHERE usuarios.id = :id_usuario ORDER BY postagens.id ASC;",
    ["id_usuario" => $user]
);
$user_data = $res->results[0];

$postagens = $res;



?>



<div class="container text-center">
    <div class="row">
        <div class="col-1">

        </div>
        <div class="col-10">

            <div class="card p-3 mt-5">
                <h3>Dados do usuário</h3>
                <div class="card">
                    <div class="card-header"><?= $user_data->nome_usuario ?></div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><?= $user_data->email ?></li>
                        <li class="list-group-item"><?= $user_data->id ?></li>
                        <li class="list-group-item">Acessou em <?= $user_data->data_acesso ?></li>
                    </ul>
                </div>
            </div>


            <hr class="mt-5":>


            <h3>Postagens de <?= $user_data->nome_usuario ?></h3>

            <?php if (!empty($postagens->results)) : ?>
                <?php foreach ($postagens->results as $posts) : ?>
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col">
                                <div class="card mb-3">
                                    <div class="card-header text-start">
                                        <div class="post__avatar">
                                            <img class="img-profile-user" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
                                            <span class="card-text">
                                                <?php if (isset($posts->nome_usuario)) {
                                                    echo '<span class="username-post">' . $posts->nome_usuario . '</span>';
                                                } else {
                                                    echo 'Usuário não encontrado';
                                                } ?></span>
                                        </div>
                                    </div>

                                    <a href="./postagem.php?user=<?= $posts->id_usuario?>&post=<?= $posts->postagem_id ?>" class="postagem">
                                    <?php if (isset($posts->postagem)) {
                                        
                                        $embeddedVideo = embedYouTubeVideo($posts->postagem);
                                        if (isset($embeddedVideo)) {
                                            echo " <div class='card-body text-center postagem'> 
                                    <span>$posts->postagem</span>
                                    <span class='card-text postagem'> $embeddedVideo</span>
                                    </div>";
                                        } else {
                                            echo " <div class='card-body text-start postagem'>

                                    <span>$posts->postagem</span>
                                
                                </div>    
                                ";
                                        }
                                    } else {
                                        echo "Post não existente";
                                    } ?>


                                    </span>
                                    </a>
                                    <div class="card-footer">
                                        <span><?= $posts->data_postagem ?> <?= $posts->hora ?></span>
                                    </div>
                                </div>
                                </div>
                                
                        <?php endforeach; ?>
                    <?php endif; ?>

                        </div>
                        <div class="col-1">

                        </div>
                    </div>
        </div>