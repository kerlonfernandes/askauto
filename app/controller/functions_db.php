<?php

require_once 'config.php';


function cadastrar($conn, $email, $password, $user_name, $key_user, $chave_recuperacao) {
    if (empty($user_name) || empty($email) || empty($password) || empty($key_user) || empty($chave_recuperacao)){
        return "Todos os campos são obrigatórios";
    }

    $stmt = $conn->prepare("INSERT INTO usuarios (nome_usuario, email, senha, key_user, chave_recuperacao, hora, data_acesso) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        echo "Erro na preparação da consulta: " . $conn->error;
        return;
    }

    // Vincule os parâmetros à consulta
    $result = $stmt->bind_param("sssssss",$user_name, $email, $password, $key_user, $chave_recuperacao, $GLOBALS['currentTime'], $GLOBALS['currentDate']);

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
}


function logUser($conn, $email, $senha){
    $userData = [];

    if (empty($email) || empty($senha)) {
        return "Erro: Todos os campos são obrigatórios!";
    }
    
    $email = $conn->real_escape_string($email); // Evita problemas com caracteres especiais
    $senha = $conn->real_escape_string($senha); // Evita problemas com caracteres especiais
    
    $query = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($query);

    if ($result === false) {
        // Ocorreu um erro na consulta SQL
        return "Erro na consulta SQL: " . $conn->error;
    }
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Acesso aos campos do registro usando $row['nome do campo']
            $user_name = $row['nome_usuario'];
            $user_email = $row['email'];
            $key_user = $row['key_user'];
            $user_id = $row['id'];

            $userData[] = $user_id;
            $userData[] = $user_name;
            $userData[] = $key_user;
            $userData[] = $email;
        }
    } else {
        // Nenhum registro encontrado com o email e senha fornecidos
        echo "Usuário não encontrado.";
    }

    $result->free();
    $conn->close();

    return $userData;
}



function postagemEnviar($conn ,$id_usuario, $postagem,){
    
    global $horaAtual;
    global $dataAtual;

    if (empty($id_usuario) || empty($postagem)) {
        return "Erro: Todos os campos são obrigatórios!";
    }
    $stmt = $conn->prepare("INSERT INTO postagens (id_usuario, postagem, hora, data_postagem	
    ) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $id_usuario, $postagem, $horaAtual , $dataAtual);

    if ($stmt->execute()) {
        // Registro inserido com sucesso
        return "Postagem realizado com sucesso!";
    } else {
        // Ocorreu um erro ao inserir o registro
        return "Erro ao Postar: " . $stmt->error;
    }

}

function exibePostagens($conn){
    $query = "SELECT p.postagem, u.id, u.nome_usuario, p.hora FROM postagens as p JOIN usuarios as u ON p.id_usuario = u.id ORDER BY p.id DESC " 
    ;
    $result = $conn->query($query);

    if ($result === false) {
        // Ocorreu um erro na consulta SQL
        return "Erro na consulta SQL: " . $conn->error;
    }

    $postagens = array(); // Inicializa um array para armazenar os resultados

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $postagens[] = $row; // Adiciona cada linha como um elemento do array
        }
    }

    return $postagens;
}


