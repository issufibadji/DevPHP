<?php

namespace core;

use app\classes\Uri;

use app\exceptions\ControllerNotExistException;
class Controller
{
    private $uri;
    //criar pastas para buscar no controllor
    private  $folders = [
        'app\controllers\portal',
        'app\controllers\admin'
    ];
    public function __construct() {
        $this->uri = Uri::uri();
    }

    //2-Criar load para carregar controller
    public function load(){

        if($this->isHome()){
            return $this->controllerHome();//se está no home carrega controllerHome
        }
        return $this->controllerNotHome();//se Não home carrega controllerNotHome()
        //os dois metodos(controllerHome()e controllerNHome()) vão trabalhar na class
    }

    //2.1-Verificação se o cotroller não existe abri exepction

    private function controllerHome(){
        if(!$this->controllerExist('HomeController')){
            throw new \ControllerExistException("Esse controlador não existe");

        }
        //se existe retona
        return $this->instantiateController();

    }
    private function controllerNotHome(){}


    //1-Se "uri = /" então estou no Home
    private function isHome(){
        return($this->uri== '/');
    }

    private function controllerExist($controller) {
        $controllerExist = false;

        foreach ($this->folders as $folder) {
            if (class_exists($folder . '\\' . $controller)) {
                $controllerExist = true;
                $this->namespace = $folder;
                $this->controller = $controller;
            }
        }

        return $controllerExist;

    }


    private function instantiateController() {
        $controller = $this->namespace . '\\' . $this->controller;
        return new $controller;
    }



}