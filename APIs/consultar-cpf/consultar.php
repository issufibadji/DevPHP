<?php

//INCLUIR AUTOLOAD
require __DIR__. '/vendor/autoload.php';


//IMPORTA SPEEDIO
use \App\WebService\Speedio;

//VAR cpf
$cpf = "709.196.081-59";

//NOVA INSTÂNCIA DE SPEEDIO

$objSpeedio = new Speedio();

//CONSULTA O CPNJ NA APIS DO SPEEDIO
$resultado = $objSpeedio->consultarcpf($cpf);


//VERIFICAR O RESULTADO
if (empty($resultado)) {
    die('Problemas ao consultar cpf');
}

//VERIFICAR ERRO DA REQUISIÇÃO 
if (isset($resultado['error'])) {
   die($resultado['error']);///se for erro imprime conteudo do erro
}


//IMPRIME O DADOS DE SUCESSO

echo "cpf: ".$cpf."\n";
exit;





