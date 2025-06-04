<?php

class Validacao
{

    public $validacoes;

    public static function validar($regras, $dados)
    {

        $validacao = new self;
        foreach ($regras as $campo => $regrasDoCampo) {
            foreach ($regrasDoCampo as $regra) {

                $valorDoCampo = $dados[$campo];
                if ($regra == 'confirmed') {
                    $validacao->$regra($campo, $valorDoCampo, $dados["{$campo}_confirmacao"]);
                } else {
                    $validacao->$regra($campo, $valorDoCampo);
                }
            }
        }
        return $validacao;
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
            $this->validacoes[] = "O $campo é obrigatório.";
        }
    }

    private function confirmed($campo, $valor, $valorDeConfirmacao)
    {
        if ($valor != $valorDeConfirmacao) {
            $this->validacoes[] = "O $campo de confirmação está diferente.";
        }
    }

    public function naoPassou(){
        return sizeof($this->validacoes) > 0;
    }
}










/*

    $validacao = Validacao::validar([
        'nome' => 'required',
        'email' => ['required', 'email', 'confirmed'],
        'senha' => ['required', 'min:8', 'max:30', 'strong']
    ], $_POST);

    if($validacao->naoPassou()){
        $_SESSION['validacoes'] = $validacao->$validacoes;
        header('location: /login');
        exit();
    }
*/