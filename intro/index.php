<?php

require_once "Programador.php";
require_once "Connect.php";
require_once "Connect2.php";

ConectarSite\conectar();

$programador = new Programador('Caique', 'PHP');

echo $programador->getNome();

echo $programador::ESPECIE;
