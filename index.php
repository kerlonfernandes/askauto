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
        postagemEnviar($conn, $user_id, $pergunta, $data_hora_atual);
        // Redirecionar para evitar reenvio do formulário
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
}
$posts = exibePostagens($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


    <style>
        .custom-loader {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 8px solid;
            border-color: #E4E4ED;
            border-right-color: #766DF4;
            animation: s2 1s infinite linear;
        }

        @keyframes s2 {
            to {
                transform: rotate(1turn)
            }
        }
    </style>
</head>


<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Enable both scrolling & backdrop</button>

                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdrop with scrolling</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <h4>Profile</h4>
                        <div class="card mt-3">
                            <div class="profile-block">
                                <div class="grid text-start">


                                    <img src="" alt="#" class="profile-pic">
                                    <span id="user" class="card-body">@<?= $user ?></span>


                                </div>

                            </div>
                            <span>@<?= $user ?></span>
                            <hr>
                        </div>
                    </div>




                </div>
                <div class="col-8">
                    <!-- Conteúdo da coluna central (área de perguntas) -->
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" name="ask">
                                <div class="mb-3">
                                    <textarea class="form-control" id="message-text" name="ask" rows="3" placeholder="Faça sua pergunta!"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar pergunta</button>
                            </form>
                        </div>
                    </div>
                    <!-- Exibição da pergunta enviada -->
                    <?php if (!empty($posts)) : ?>
                        <?php foreach ($posts as $post) : ?>
                            <div class="card mt-3" style="border:1px solid black;">
                                <div class="profile-block" style="border:1px solid black; border-radius:10px;">
                                    <div class="grid text-start">
                                        <div class="g-col-6">
                                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt="#" class="profile-pic">
                                            <span id="user" class="card-body" style="font-weight:bold;">@<?= $post['nome_usuario'] ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <span><?= $post['postagem'] ?></span>
                                    <div class="card-footer">
                                        <span style="margin-left:-10px;"><?= $post['data_postagem'] ?></span>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else : ?>
                            <p>Nenhuma postagem encontrada.</p>
                        <?php endif ?>
                            </div>
                </div>
            </div>
            <footer>
                <div class="footer-head" style="margin-top:25px;">

                </div>
            </footer>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>