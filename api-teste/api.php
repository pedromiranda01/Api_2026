<?php
    //cabecalho
    header("Content-Type: application/json; charset=UTF-");

    $metodo = $_SERVER['REQUEST_METHOD'];

    $arquivo = 'usuarios.json';

    if (!file_exists($arquivo)) {
        file_put_contents($arquivo, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    $usuarios = json_decode(file_get_contents($arquivo),true);

    // $usuarios = [
    //     ["id" =>1, "nome" => "Maria", "email" => "maria@gmail.com"],
    //     ["id" =>2, "nome" => "Joao", "email" => "joao@gmail.com"]
    // ];

   switch ($metodo) {

    case 'GET':
        // Verifica se há um parâmetro "id" na URL
        if (isset($_GET["id"])) {
            $id = intval($_GET["id"]);
            $usuario_encontrado = null;

            // Procura o usuário pelo ID
            foreach ($usuarios as $usuario) {
                if ($usuario['id'] == $id) {
                    $usuario_encontrado = $usuario;
                    break;
                }
            }

            if ($usuario_encontrado) {
                echo json_encode($usuario_encontrado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(404);
                echo json_encode(["erro" => "Usuário não encontrado."], JSON_UNESCAPED_UNICODE);
            }

        } else {
            // Retorna todos os usuários
            echo json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        break;


    case 'POST':
        $dados = json_decode(file_get_contents('php://input'), true);

    // Verifica campos obrigatórios (sem exigir o ID)
    if (!isset($dados["nome"]) || !isset($dados["email"])) {
        http_response_code(400);
        echo json_encode(["erro" => "Nome e email são obrigatórios."], JSON_UNESCAPED_UNICODE);
        break;
    }

    // Gera um novo ID único
        $novo_id = 1;
    if (!empty($usuarios)) {
        $ids = array_column($usuarios, 'id');
        $novo_id = max($ids) + 1;
    }

    $novo_usuario = [
        "id" => $novo_id,
        "nome" => $dados["nome"],
        "email" => $dados["email"]
    ];

    // Adiciona o novo usuário
    $usuarios[] = $novo_usuario;

    // Salva no arquivo
    file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Retorna confirmação
http_response_code(201);
    echo json_encode([
        "mensagem" => "Usuário inserido com sucesso!",
        "usuario" => $novo_usuario
    ], JSON_UNESCAPED_UNICODE);
    break;


default:
    http_response_code(405); // Método não permitido
    echo json_encode(["erro" => "Método não permitido"], JSON_UNESCAPED_UNICODE);
break;
}


    //conteudo
    // $usuarios = [
    //     ["id" =>1, "nome" => "Maria", "email" => "maria@gmail.com"],
    //     ["id" =>2, "nome" => "Joao", "email" => "joao@gmail.com"]
    // ];

    // //converte para json e retorna
    // echo json_encode($usuarios);


?>