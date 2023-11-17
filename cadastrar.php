<?php
// require('header.php');
require_once('./app/controller/config.php');
require_once('./app/controller/functions_db.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Coletar dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $confirma_senha = $_POST['confirm-password'];
    $user_name = $_POST['user-name'];

    $stmt = $conn->prepare("INSERT INTO usuarios (nome_usuario, email, senha, key_user, chave_recuperacao, hora, data_acesso) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo "Erro na preparação da consulta: ";
        return;
    }

    // Vincule os parâmetros à consulta
    $result = $stmt->bind_param("sssssss",$user_name, $email, $senha, $key_user, $chave_recuperacao, $GLOBALS['currentTime'], $GLOBALS['currentDate']);

    if ($result === false) {
        echo "Erro na vinculação de parâmetros: " . $stmt->error;
        return;
    }
    if ($stmt->execute()) {
        echo "Cadastro realizado com Sucesso!";
    } else {
        echo "Erro ao cadastrar usuário: " . $stmt->error;
    }
    
    $stmt->close();

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/style.css">

</head>

<body>
    <section>

        <div class="area-form">
            <div class="cad">

                <form method="POST" id="form-cadastro">

                    <input type="text" name="user-name" placeholder="Nome de usuário" autofocus style="font-family: 'Oswald', sans-serif;
            ">
                    <input type="email" name="email" placeholder="Email" autofocus style="font-family: 'Oswald', sans-serif;
            ">
                    <input type="password" name="password" placeholder="Senha" autofocus style="font-family: 'Oswald', sans-serif;
            ">
                    <input type="password" name="confirm-password" placeholder="Confirme sua senha" autofocus style="font-family: 'Oswald', sans-serif;
            ">
                    <input class="hov" type="submit" value="entrar">

                </form>
                <p>já tem conta? <a href="index.php">Login</a></p>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script>


</script>

</body>

</html>