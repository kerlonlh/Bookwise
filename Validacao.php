<?php

class Validacao
{

    public $validacoes = [];

    public static function validar($regras, $dados)
    {

        $validacao = new self;
        foreach ($regras as $campo => $regrasDoCampo) {
            foreach ($regrasDoCampo as $regra) {

                $valorDoCampo = $dados[$campo];
                if ($regra == 'confirmed') {
                    $validacao->$regra($campo, $valorDoCampo, $dados["{$campo}_confirmacao"]);
                } elseif(str_contains($regra, ':')){
                    $temp = explode(':', $regra);
                    $regra = $temp[0];
                    $regraAr = $temp[1];
                    $validacao->$regra($regraAr, $campo, $valorDoCampo);

                } else {
                    $validacao->$regra($campo, $valorDoCampo);
                }
            }
        }
        return $validacao;
    }

    private function unique($tabela, $campo, $valor){
        if(strlen($valor) == 0){
            return;
        }

        $db = new Database(config('database'));

        $resultado = $db->query(
            query:"SELECT * FROM $tabela WHERE $campo = :valor",
            params: ['valor' => $valor]
        )->fetch();

        if($resultado) {
            $this->validacoes[] = "O $campo já está sendo usado.";
        }
    }


    private function required($campo, $valor)
    {
        if (strlen($valor) == 0) { 
            $this->validacoes[] = "O $campo é obrigatório.";
        }
    }

    private function email($campo, $valor)
    {
        if (! filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            $this->validacoes[] = "O $campo é inválido.";
        }
    }

    private function confirmed($campo, $valor, $valorDeConfirmacao)
    {
        if ($valor != $valorDeConfirmacao) {
            $this->validacoes[] = "O $campo de confirmação está diferente.";
        }
    }

    private function min($min, $campo, $valor){
        if(strlen($valor) <= $min){
            $this->validacoes[] = "$campo precisar ter no mínimo de $min caracteres.";
        }
    }

    private function max($max, $campo, $valor){
        if(strlen($valor) > $max){
            $this->validacoes[] = "$campo precisar ter no máximo de $max caracteres.";
        }
    }

    private function strong($campo, $valor){
        if(! strpbrk($valor, '!@#$%^&*()_-[\];.,?|')){
            $this->validacoes[] = "$campo precisa ter um caracter especial nela.";
        }
    }

    public function naoPassou($nomeCustomizado = null){

        $chave = 'validacoes';
        if($nomeCustomizado){
            $chave .= '_'. $nomeCustomizado;
        }

        flash()->push($chave, $this->validacoes);
        //$_SESSION['validacoes'] = $this->validacoes;
        return sizeof($this->validacoes) > 0;
    }
}
