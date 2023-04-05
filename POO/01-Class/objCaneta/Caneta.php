<?php

class Caneta {
    var $modelo;
    var $marca;
    var $cor;
    var $ponta;
    var $carga;
    var $tampada;


    function rabiscar() {
        if ($this->tampada==true){
            echo "ERRO! Não posso rabiscar";

        }else{
            echo "Estou rabiscando...";
        }

    }

    function tampar(){
     $this->tampada=true;
        

    }

    function destampar(){
        $this->tampada=false;

    }

    function novo(){
if ( $this->carga==true) {
   echo "Inteira";
} else {
    echo "Usado";
}


       
    }

    function seminovo(){
        
    }

}
