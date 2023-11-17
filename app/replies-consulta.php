<?php
session_start();


include_once('./controller/functions_db.php');
include_once('./controller/config.php');

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


<?php if($respostas->results): ?>
<?php foreach ($respostas->results as $res) : ?>

<div class="card mb-3 mt-5 p-3 custom-card">
    <div class="card-header">
        <div class="post__avatar">
            <img class="img-profile-user" src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png" alt="" />
            <span class="card-text">
                <?php if (isset($res->nome_usuario)) {
                    echo $res->nome_usuario;
                } else {
                    echo 'Usuário não encontrado';
                } ?></span>
        </div>
    </div>
    <div class="card-body">

        <?php
        echo $res->resposta;
        ?>
    </div>

    </form>
    <div class="card-footer">
        <span><?= $res->data_resposta ?> <?= $res->hora_resposta ?></span>
    </div>
</div>

<?php endforeach ?>
<?php else:?>

    <span style="margin:320px; font-weight:bold;">Ainda Não há comentários <hr></span>

<?php endif; ?>