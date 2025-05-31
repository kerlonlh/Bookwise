<?php 

$pesquisar = $_REQUEST['pesquisar'] ?? '';

$livros = $database->query(
    query: "SELECT * FROM livros WHERE titulo like :filtro OR descricao LIKE :filtro OR autor LIKE :filtro", 
    class: Livro::class, 
    params: ['filtro' => "%$pesquisar%"]
    )->fetchAll();
    

view ('index', compact('livros'));