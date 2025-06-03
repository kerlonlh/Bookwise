<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $database->query(
    query:"INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)",
    params: [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'senha' => $_POST['senha']
        ]
    );

    header('location: /login?mensagem=Registrado com sucesso!');
    exit();

}
