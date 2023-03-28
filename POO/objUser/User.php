<?php
class User
{
    var $nome;
    var $email;
    var $senha;
    var $logado;

    function logar()
    {
        if ($this->senha == "123456") {
            $this->logado = true;
            echo "$this->nome está logado!";
        } else {
            $this->logado = false;
            echo "ERRO! $this->nome não está logado";
            echo "\n"."Usuario ou senha incorreta". "\n";
            echo "Contate o administrador.";
        }
    }
}
