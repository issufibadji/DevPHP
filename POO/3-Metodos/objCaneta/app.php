<?php

require_once 'Caneta.php';

$objCan1 = new Caneta;
$objCan2 = new Caneta("2016", "Vermelho", 4.0);
$objCan1->marca = "Big";
$objCan1->setModelo("2300");
$objCan1->setPonta(0.7);
print_r($objCan1);
echo "\n";
print_r($objCan2);
echo "\n";
