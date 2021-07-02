<?php

namespace App\Core;

class Router{

    private $controller;

    private $method = "index";
    
    private $params;

    function __construct(){

        //recuperar a url que está sendo 
        $url = $this->parseURL();

        if(isset($url[1]) && file_exists("../App/Controller/" . $url[1] . ".php")){
            $this->controller = $url[1];
            unset($url[1]);

        }elseif(empty($url[1])){
            //setamos o controler padrão da aplicação (produtos)
            $this->controller = "Produtos";
        }else{
            //se nçao existir e houver um controller na url
            //exibimos página não encontrada
            print_r($url);
            $this->controller = "erro404";
        }

        //importamos o controlelr
        require_once "../App/Controller/" . $this->controller . ".php";

        //onstancia do controller
        $this->controller = new $this->controller;

        //se houver um metodo e ele existir no controler
        //atribuimos ao atributo method
        if (isset($url[2])) {
            if (method_exists($this->controller, $url[2])) {
                $this->method = $url[2];
                unset($url[2]);
                unset($url[0]);
            }
        }

        //pegamos os parametro da url
        $this->params = $url ? array_values($url) : [];

        //executamos o metodo dentro do controler, passando os parametro
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    //Recuperar a URL e retornar os parametros
    private function parseURL(){
        return explode("/", $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]);
    }
}