<?php

class CaixaDeSom
{

    var $caixa;
    var $falante;
    var $botao;
    var $led;
    var $volume;
    var $status;

    function ApertarBotao()
    {
        if ($this->botao == true) {
            $this->status = "LIGADO";
        } else {
            $this->status = "DESLIGADO";
        }
    }

    function ligar()
    {
        if ($this->botao == true) {
            $this->falante = "Toca musica";
        }
    }

    function desligar()
    {
        if ($this->botao == false) {
            $this->led = "APAGADO";
        } else {
            $this->led = "ACESO";
        }
    }

    function volume()
    {
        if ($this->botao == true) {
            $this->volume = "1 à 100";
        }
    }
}
