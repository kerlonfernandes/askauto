<?php
use Midspace\Database;

require_once 'config.php';
require_once("Database.php");

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
    $query = "SELECT p.postagem, p.id AS postagem_id, u.id AS user_id , u.nome_usuario, u.id ,p.hora, p.data_postagem FROM postagens as p JOIN usuarios as u ON p.id_usuario = u.id ORDER BY p.id DESC;" 
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
function exibeRespostas($conn){
    $query = "SELECT p.id AS id_postagem, p.id_usuario AS id_usuario_postagem, p.postagem, p.hora AS hora_postagem, p.data_postagem, r.id AS id_resposta, r.id_usuario AS id_usuario_resposta, r.resposta, r.data_resposta FROM postagens p LEFT JOIN respostas r ON p.id = r.id_postagem ORDER BY p.id, r.data_resposta;" 
    ;
    $result = $conn->query($query);

    if ($result === false) {
        // Ocorreu um erro na consulta SQL
        return "Erro na consulta SQL: " . $conn->error;
    }

    $respostas = array(); // Inicializa um array para armazenar os resultados

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $respostas[] = $row; // Adiciona cada linha como um elemento do array
        }
    }

    return $respostas;
}


function perfis($conn, $id){
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = $result->fetch_row();
    
    return $data;


}

function exibePostagem($conn, $id_post){

    $query = "SELECT p.postagem, p.id AS postagem_id, u.id AS user_id, u.nome_usuario, u.id, p.hora, p.data_postagem FROM postagens AS p JOIN usuarios AS u ON p.id_usuario = u.id WHERE p.id = ? ORDER BY p.id DESC;
    ;
    "; 
    
    $stmt = $conn->prepare($query);
    
    $stmt->bind_param("i", $id_post); // Use $id_post em vez de $id
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result === false) {
        // Ocorreu um erro na execução da declaração
        echo "Erro na execução da declaração: " . $stmt->error;
    } else {
        $postagens = array(); // Inicializa um array para armazenar os resultados
    
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $postagens[] = $row; // Adiciona cada linha como um elemento do array
            }
            
            return $postagens;
            
        } else {
           return;
        }
    }
    


}
function embedYouTubeVideo($input) {
    $videoId = getYoutubeVideoId($input);

    if ($videoId) {
        $embedCode = '
        <hr>
        <iframe width="545" height="315" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
        return $embedCode;
    } else {
        return;
    }
}

function getYoutubeVideoId($url) {
    $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/|v\/)?([a-zA-Z0-9_\-]{11})/';
    preg_match($pattern, $url, $matches);

    if (isset($matches[1])) {
        return $matches[1];
    } else {
        return false;
    }
}

function respostas($id_postagem) {
    $query = new Database(MYSQL_CONFIG);

    return $query->execute_query(
        "SELECT respostas.*, usuarios.nome_usuario
        FROM respostas
        JOIN usuarios ON usuarios.id = respostas.id_usuario
        WHERE respostas.id_postagem = :id_postagem
        ORDER BY respostas.id DESC;",
        ["id_postagem" => $id_postagem]
    );
}

function responder($id, $id_usuario, $resposta){
    global $horaAtual;
    global $dataAtual;

    $query = new Database(MYSQL_CONFIG);
    $query->execute_non_query("INSERT INTO respostas (resposta, id_usuario, id_postagem, hora_resposta, data_resposta) VALUES (:resposta, :id_usuario, :id_postagem, :hora_resposta , :data_resposta)", ['resposta' => $resposta, "id_usuario" => $id_usuario, "id_postagem" => $id, "hora_resposta" =>  $GLOBALS['currentTime'], "data_resposta" => $GLOBALS['currentDate']]);
    

}