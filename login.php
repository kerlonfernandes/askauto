<?php
require_once('./app/controller/functions_db.php');

session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
}
if (!empty($email) || !empty($password)) {
    $data = logUser($conn, $email, $password);

    foreach ($data as $d => $value) {
        $user_id = $data[0];
        $user_name = $data[1];
        $key_user = $data[2];
    }
    $_SESSION['user_name'] = $user_name;
    $_SESSION['key_user'] = $key_user;
    $_SESSION['id_user'] = $user_id;
    setcookie('user_name', $user_name);



    if (!empty($data)) {
        header('location: ./home.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/style.css">


</head>

<body>
    <section>

        <div class="area-form">
            <div class="login">

                <form method="post">
                    <input class="email" type="email" name="email" placeholder="Email" autofocus style="font-family: 'Oswald', sans-serif;
                    ">
                    <input type="password" name="password" placeholder="Senha" autofocus style="font-family: 'Oswald', sans-serif;
                    ">
                    <input class="hov" type="submit" value="entrar">

                </form>
                <p>Ainda não tem conta? <a href="cadastrar.php">Criar conta</a></p>
            </div>
        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>