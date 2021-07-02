<?php

    namespace App\Core;

    class Controller {

        //recebemos o model a ser instanciado
        //retornamos a instancia pronta
        public function Model($model){
            require_once("../App/Model/" . $model . ".php");
            return new $model;
        }

        public function view($view, $dados = []){
            require_once "../App/View/template.php";
        }
    }