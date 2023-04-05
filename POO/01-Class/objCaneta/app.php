<?php

require_once 'Caneta.php';

$objCan1 = new Caneta;
$objCan2 = new Caneta;
$objCan1->marca = "Big";
$objCan1->cor = "Azul";
$objCan1->modelo = "2017";
$objCan1->ponta = 0.5;
$objCan1->tampada = false;
$objCan1->carga = false;

//Caneta Vermelho
$objCan2->marca = "Big";
$objCan2->cor = "vermelho";
$objCan2->modelo = "2023";
$objCan2->ponta = "0.6";
$objCan2->carga = true;


print_r($objCan1);
echo "\n";
//METODO CARGA
$objCan1->novo();
echo "\n";
//METODO RABISCAR
$objCan1->rabiscar();
echo "\n";
//Obj instanciado

print_r($objCan2);
echo "\n";
$objCan2->novo();
echo "\n";
$objCan2->rabiscar();
