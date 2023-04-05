<?php
class Celular
{
    var $marca;
    var $modelo;
    var $cor;
    var $bateria;
    var $fone;
    var $ligado;

    function ligar()
    {
        if ($this->bateria > 0) {
            $this->ligado = true;
            echo "Hello i am on<br>";
        } else {
            echo "não podemos ligar sem bateria<br>";
        }
    }
    function desligar()
    {
        $this->ligado = false;
    }
    function carregar()
    {
        if ($this->bateria == 100) {
            echo "já estou carregada gato<br>";
        } else {
            $this->bateria = 100;
            echo "que delicia estou carregadinha<br>";
        }
    }
    function radio()
    {
        if ($this->bateria > 0) {
            if ($this->ligado) {
                if ($this->fone) {
                    echo "Radio Ligado<Br>";
                } else {
                    echo "Radio sem fone<br>";
                }
            } else {
                echo "celular desligado não podemos ligar o radio<br>";
            }
        } else {
            echo "Erro! Radio não pode ligar pois estamos sem bateria<br>";
        }
    }
    function foneOn()
    {
        $this->fone = true;
    }
    function foneOff()
    {
        $this->fone = false;
    }
}
