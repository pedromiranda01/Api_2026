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

    switch($metodo){
        case 'GET' :
            //echo "AQUI AÇÕES DO METODO GET";
            echo json_encode($usuarios);
            break;
        case 'POST' :
            //echo "AQUI AÇÕES DO METODO POST";
            $dados = json_decode(file_get_contents('php://input'),true);
            //print_r($dados);
            $novoUsuario = [
                "id" => $dados["id"],
                "nome" => $dados["nome"],
                "enail" => $dados["email"],
            ];

            array_push($usuarios, $novoUsuario);
            echo json_encode('Usuário inserido com sucesso!');
            print_r($usuarios);

            break;
        case 'PUT' :
            echo "AQUI AÇÕES DO METODO PUT";
            break;
        case 'DELETE' :
            echo "AQUI AÇÕES DO METODO DELETE#";
            break;

        default:
            echo "MÉTODO NÃO ENCONTRADO!";
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