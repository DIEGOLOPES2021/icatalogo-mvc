<?php

use App\Core\Model;

// implementar a listagem de categorias:

// Criar a view de listagem de categorias OK
// Criar o controller OK
// Criar o model e o método listar todos OK
// 	não esqueça do css da tela de categorias OK

// DESAFIO:    
// TENTAR IMPLEMENTAR A INCLUSÃO DE CATEGORIA    
class Categoria
{

    public $id;
    public $descricao;

    public function listarTodas()
    {
        $sql = "SELECT * FROM tbl_categoria";
        //preparamos a consulta
        $stmt = Model::getConexao()->prepare($sql);
        //executamos a consulta
        $stmt->execute();

        //verificamos a quantidade de linhas
        if ($stmt->rowCount() > 0) {
            //pegamos os resultados em forma de lista de objetos
            $resultado = $stmt->fetchAll(\PDO::FETCH_OBJ);

            //retornamos o resultado
            return $resultado;
        } else {
            return [];
        }
    }

    public function inserir()
    {

        $sqlInsert = " INSERT INTO tbl_categoria (descricao) 
                        VALUES (?) ";

        $stmt = Model::getConexao()->prepare($sqlInsert);
        $stmt->bindValue(1, $this->descricao);
        //executamos a consulta
        if ($stmt->execute()) {
            //se der certo, atribuir o id inserido a instância desta classe
            $this->id = Model::getConexao()->lastInsertId();
            return $this;
        } else {
            return false;
        }
    }

    public function buscarPorId($id)
    {

        $sql = " SELECT * FROM tbl_categoria WHERE id = ? ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $categoria = $stmt->fetch(PDO::FETCH_OBJ);

            $this->id = $categoria->id;
            $this->descricao = $categoria->descricao;
            return $this;
        } else {
            return false;
        }
    }

    public function atualizar()
    {

        $sql = " UPDATE tbl_categoria SET descricao = ? WHERE id = ? ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->descricao);
        $stmt->bindValue(2, $this->id);

        return $stmt->execute();
    }

    public function deletar()
    {

        $sql = " DELETE FROM tbl_categoria WHERE id = ? ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->id);

        return $stmt->execute();
    }
}
