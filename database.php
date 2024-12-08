<?php 

class DB {
    public function livros(){
        $db = new PDO('sqlite:database.sqlite');
        $query = $db->query("SELECT * FROM livros");
        return $query->fetchAll();
    }
}


?>