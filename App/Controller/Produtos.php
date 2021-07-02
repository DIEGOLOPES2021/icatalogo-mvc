<?php

use App\Core\Controller;

class Produtos extends Controller{

    //listagem
    public function index(){

        $produtoModel = $this->Model("Produto");

        $produtos = $produtoModel->listarTodos();

        $this->view("produtos/index", $produtos);
    }

    //buscar pelo id

    //retornar a vire de edição

    //salvar a edição

    //retornar a vire de inserção

    //salvar a inserção

    //deletar

}