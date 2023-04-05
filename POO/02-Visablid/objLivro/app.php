<?php

require_once './Livro.php';

$objl1 = new Livro();
$$objl1->paginas = 300;
$$objl1->peso = "0.5kg";
$$objl1->tamanho = "30 cm";
$$objl1->preco = "R$100";
$$objl1->genero = "Ficção ";
$$objl1->fechar();
print_r($$objl1);
