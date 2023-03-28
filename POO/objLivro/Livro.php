<?php
class Livro {

    var $paginas;
    var $tamanho;
    var $peso;
    var $genero;
    var $preco;
    var $fechado;

    function ler() {
        if ($this->fechado == true) {
            echo "Não consegue ler!";
        } else {
            echo "Lendo...";
        }
    }

    function fechar() {
        $this->fechado = true;
    }

    function abrir() {
        $this->fechado = false;
    }

}

