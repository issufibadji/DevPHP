<?php

namespace App\WebService;

//CLASSE PARA SPEEDIO
class Speedio{

    /**
     * URL base da API do Speedio
     * @var string
     */

     const URL_BASE = 'https://api-publica.speedio.com.br';

     /**
      * Método responsável por consultar um CNPJ nas APIs do speedio
      *@param string $cnpj
      *@return array
      */
      public function consultarCNPJ($cnpj){
        
        //REMOVE OS CARACTERS INVÁLIDOS
        $cnpj = PREG_REPLACE('/\D/', '', $cnpj);

        
        //RETORNA A EXCUÇÃ DA CONSULTA
        return $this->get('/buscarcnpj?cnpj=' .$cnpj);
      }
      

      /**
       * Método responsável por executar a consulta nas APIs do Speedio
       * @param string $resource //retorana string 
       * @return array //retorna array
       * 
       */
      public function get($resource){
        //ENDIPOINT COMPLETO DA API
        $endpoint = self::URL_BASE.$resource;//concactenar nosso $resource

       //CURL PARA EXCUTAR A NOSSA REQUESIÇÃO

      // INICIA O CURL
        $curl = curl_init();
        
        //CONFIGURAÇÕES DO CURL
       // METODO/FUNC DE CURL PARA PASSAR ARRAY
        curl_setopt_array($curl, [

          CURLOPT_URL => $endpoint,// ENDEPOIT PARA ONDE ELE VAI ENVIAR ESTA REQUISIÇAO
          CURLOPT_RETURNTRANSFER => true, //PARA RETORNA CONTEUDO E NÃO IMPRIMIR NA TELA
          CURLOPT_CUSTOMREQUEST => 'GET' //NOSSA REQUISÃO GET
        ]);


         //EXCUTAR A REQUISIÇÃO
         $response = curl_exec($curl);

         //FECHA A CONEXÃO
         curl_close($curl);


         //RESPONSE A ARRAY
         $responseArray = json_decode($response,true); 

        //RETURNO ARRAY COM DADOS
         return is_array($responseArray)? $responseArray : [];//SE FOR ARRAY RESPONDE SE NÃO RETORNA VAZIO

        


      }
    }