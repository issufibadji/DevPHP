<?php

class Caneta
{
    private $modelo;
    public $marca;
    public $cor;
    private $ponta;
    private $carga;
    private $tampada;

    //CONSTRUTOR
    /**
     * O MÉTODO CONSTRUTOR PODE TER TAMBEM MESMO NOME COM CLASS"Caneta" ou __contruct
     */
    // public function __contruct(){
    //     $this->cor = "Azul";
    //     $this->tampar();
    // }

    public function Caneta($m = null, $c = null, $p = null)
    {
        $this->modelo = $m;
        $this->cor = $c;
        $this->ponta = $p;
        $this->tampar();
    }
    public  function tampar()
    {
        $this->tampada = true;
    }

    //MÉTODOS GET E SET
    public function getModelo()
    {
        return $this->modelo;
    }

    public function setModelo($m)
    {
        $this->modelo = $m;
    }


    public function getPonta()
    {
        return $this->ponta;
    }

    public function setPonta($p)
    {
        $this->ponta = $p;
    }


    public function  rabiscar()
    {
        if ($this->tampada == true) {
            echo "ERRO! Não posso rabiscar";
        } else {
            echo "Estou rabiscando...";
        }
    }
}
