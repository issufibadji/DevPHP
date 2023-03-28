<?php

require_once "User.php";

$bojUser = new  User;
$bojUser ->nome = "Issufi";
$bojUser ->email = "email@gmail.com";
$bojUser ->senha = "1234";
$bojUser ->logado = true;

echo"\n";
$bojUser->logar();
echo"\n";
print_r($bojUser);
