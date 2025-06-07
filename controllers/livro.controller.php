<?php 

$livro = $database
    ->query(
        query: "SELECT * FROM livros WHERE id = :id",
        class: Livro::class,
        params: ['id' => $_REQUEST['id']])
    ->fetch();

$avaliacoes = $database
    ->query(
        query:"SELECT * FROM avaliacoes WHERE livro_id = :id",
        class: Avaliacao::class,
        params: ['id' => $_GET['id']])
    ->fetchAll();




view('livro', compact('livro', 'avaliacoes'));

?>
