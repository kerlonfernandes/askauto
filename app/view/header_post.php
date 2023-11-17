<?php

$BASE_URL = "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI'] . "?") . "/";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AskAuto - Faça sua pergunta Automotiva!</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="./public/css/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lilita+One&family=Merriweather+Sans&family=Shantell+Sans:wght@400;700&family=Ubuntu:wght@300;400;500;700&family=Work+Sans:wght@300;400&display=swap');


        .img-profile-user {
            width: 48px;
            height: 48px;
        }
        .username-post {
  text-decoration: none;
  font-weight: bold;
  color: black;
  position: relative;
  overflow: hidden;
}

.username-post::before {
  content: "";
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background-color: black;
  transition: width 0.3s ease-in-out; /* A transição controla o surgimento da linha */
}

.username-post:hover::before {
  width: 100%; /* Quando o mouse passa sobre o elemento, a linha aparece gradualmente */
}

.postagem {

    text-decoration: none;
    color: black;

}
    </style>
    
</head>

<body>



    <nav class="navbar bg-body-tertiary background-color:white;">
        <div class="container-fluid">
            <a href="../" class="navbar-brand"><span style="font-family: 'Work Sans', sans-serif;"><img src="<?= $BASE_URL ?>../public/images/logo.jpg" alt="logo-ask-auto" style="border-radius:10px;"></span></a>

        </div>
    </nav>