<?php

class Caneta
{
    public $modelo;
    public $marca;
    public $cor;
    private $ponta;
    protected $carga;
    protected $tampada;



    public function  rabiscar()
    {
        if ($this->tampada == true) {
            echo "ERRO! Não posso rabiscar";
        } else {
            echo "Estou rabiscando...";
        }
    }

    private  function tampar()
    {
        $this->tampada = true;
    }

    public function destampar()
    {
        $this->tampada = false;
    }

    public function novo()
    {
        if ($this->carga == true) {
            echo "Inteira";
        } else {
            echo "Usado";
        }
    }
}
