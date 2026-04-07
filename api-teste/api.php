<?php
    //cabecalho
    header("Content-Type: application/json");


    //conteudo
    $usuarios = [
        ["id" =>1, "nome" => "Maria", "email" => "maria@gmail.com"],
        ["id" =>2, "nome" => "Joao", "email" => "joao@gmail.com"]
    ];

    //converte para json e retorna
    echo json_encode($usuarios);


?>