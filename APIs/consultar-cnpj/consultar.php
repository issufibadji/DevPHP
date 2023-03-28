<?php

//INCLUIR AUTOLOAD
require __DIR__. '/vendor/autoload.php';


//IMPORTA SPEEDIO
use \App\WebService\Speedio;

//VAR CNPJ
$cnpj = "00.000.000/0001-91";

//NOVA INSTÂNCIA DE SPEEDIO

$objSpeedio = new Speedio();

//CONSULTA O CPNJ NA APIS DO SPEEDIO
$resultado = $objSpeedio->consultarCNPJ($cnpj);


//VERIFICAR O RESULTADO
if (empty($resultado)) {
    die('Problemas ao consultar CNPJ');
}

//VERIFICAR ERRO DA REQUISIÇÃO 
if (isset($resultado['error'])) {
   die($resultado['error']);///se for erro imprime conteudo do erro
}


//IMPRIME O DADOS DE SUCESSO

echo "CNPJ: " .$cnpj."\n";
echo "RAZAO SOCIAL: " .$resultado['RAZAO SOCIAL']."\n";
echo "NOME FANTASIA: " .$resultado['NOME FANTASIA']."\n";
echo "CEP: " .$resultado['CEP']."\n";
echo "DATA ABERTURA: " .$resultado['DATA ABERTURA']."\n";
echo "DATA ABERTURA: " .$resultado['DDD']."\n";
echo "TELEFONE: " .$resultado['TELEFONE']."\n";
echo "EMAIL: " .$resultado['EMAIL']."\n";
echo "LOGRADOURO: " .$resultado['LOGRADOURO']."\n";
echo "BAIRRO: " .$resultado['BAIRRO']."\n";
echo "MUNICIPIO: " .$resultado['MUNICIPIO']."\n";
echo "UF: " .$resultado['UF']."\n";
exit;





