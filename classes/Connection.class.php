<?php

class Connect{
    public function connectar(){
    try{
        $pdo = new PDO("mysql:dbname=classificados;host=localhost","root","");
    }   catch(PDOException $e){
    echo "Falhou".$e->getMessage();
    exit;
        }
    }
}

?>