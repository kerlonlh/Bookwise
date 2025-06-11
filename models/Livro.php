<?php

class Livro
{
    public $id;
    public $titulo;
    public $autor;
    public $descricao;
    public $ano_de_lancamento;
    public $usuario_id;
    public $nota_avaliacao;
    public $count_avaliacoes;

    public static function get($id)
    {
        return (new self)->query('l.id = :id', ['id' => $id])->fetch();
    }

    public static function all($filtro = '')
    {
        return (new self)->query('titulo LIKE :filtro OR descricao LIKE :filtro OR autor LIKE :filtro', ['filtro' => "%$filtro%"])->fetchAll();
    }

    public static function meus($usuario_id)
    {
        return (new self)->query('l.usuario_id = :usuario_id', ['usuario_id' => $usuario_id])->fetchAll();
    }

    public function query($where, $params){

        $database = new Database(config('database'));
        return $database->query(
            query: "
                SELECT 
                    l.id, l.titulo, l.descricao, l.ano_de_lancamento,
                    ifnull(round(sum(a.nota) / count(a.id)), 0) as nota_avaliacao,
                    ifnull(count(a.id), 0) as count_avaliacoes
                FROM livros l
                LEFT JOIN avaliacoes a ON a.livro_id = l.id
                WHERE $where
                GROUP BY l.id, l.titulo, l.descricao, l.ano_de_lancamento",
            class: self::class,
            params: $params
        );
    }
}
