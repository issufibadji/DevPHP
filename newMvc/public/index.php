<?php

require '../boostrap.php';

use core\Controller;
use core\Method;
use core\Parameters;

// https://devcurso.com.br/curso/php

dd(\app\classes\Uri::uri());//verificaçao

$controller = new Controller;
$controller = $controller->getController();


//$method = new Method;
//$method = $method-> getMetod();
//
//$parameters = new Parameters;
//$parameters = $parameters->getParameters();
//

