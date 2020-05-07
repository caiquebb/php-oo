<?php

class Pessoa
{
    const ESPECIE = "Humana";

    protected $nome;

    public function __construct($nome)
    {
        $this->setNome($nome);
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }
}
