<?php

require_once 'CaixaSon.php';

$cx = new CaixaDeSom();

$cx->botao = TRUE;
$cx->status = "";
$cx->led = "";
$cx->caixa = "METEORO";
$cx->falante = "0";
$cx->volume = "0";

$cx->ApertarBotao();
$cx->volume();
$cx->ligar();
$cx->desligar();
print_r($cx);
