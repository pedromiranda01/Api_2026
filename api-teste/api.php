<?php
    //cabecalho
    header("Content-Type: application/json");

    $metodo = $_SERVER['REQUEST_METHOD'];

    //echo "Método de requisição: ".$metodo;

    switch($metodo){
        case 'GET' :
            echo "AQUI AÇÕES DO METODO GET";
            break;
        case 'POST' :
            echo "AQUI AÇÕES DO METODO POST";
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