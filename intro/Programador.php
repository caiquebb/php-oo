<?php

require_once "Pessoa.php";

class Programador extends Pessoa
{
    private $linguagem;

    public function __construct($nome, $linguagem)
    {
        $this->setNome($nome);
        $this->setLinguagem($linguagem);

        echo "<br>Objeto ".__CLASS__." foi instanciado.<br>";
    }

    public function setLinguagem($linguagem)
    {
        $this->linguagem;
    }

    public function getLinguagem()
    {
        return $this->linguagem;
    }
}
