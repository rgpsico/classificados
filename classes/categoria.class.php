<?php 
class Categorias{
    public function getLista(){
        $array = array();
        global $pdo;

        $sql = $pdo->query("SELECT * FROM categoria");
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();

        }
        return $array;
    }

    public function getCategoriaByID($id){
        $array = array();
        global $pdo;

        $sql = $pdo->query("SELECT * FROM categoria where id = :id");
        $sql->bindValue(":id", $id);
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();

        }
        if($sql->rowCount() == 0){
            $array = ['result'=>"usuario não entrado"];

        }
        return $array;
    }

}