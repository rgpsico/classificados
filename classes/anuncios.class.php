<?php 
class Anuncios{
    public function getTotalAnuncios(array $filtros){
        global $pdo;

        $filtrosString = array('1=1');

        if(!empty($filtros['categoria'])){
            $filtrosString[] = 'anuncios.id_categoria = :id_categoria';
        }

        if(!empty($filtros['preco'])){
            $filtrosString[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
        }

        if(!empty($filtros['estado'])){
            $filtrosString[] = 'anuncios.estado = :estado';
        }

        $sql = $pdo->prepare("SELECT COUNT(*) as c from anuncios WHERE ".implode(' AND ',$filtrosString));
        
        
        if(!empty($filtros['categoria'])){
            $sql->bindValue(':id_categoria',$filtros['categoria']);
        }

        if(!empty($filtros['preco'])){

        $preco = explode('-',$filtros['preco']);
        $sql->bindValue(':preco1',$preco[0]);
        $sql->bindValue(':preco2',$preco[1]);
        }   

        if(!empty($filtros['estado'])){
            $sql->bindValue(':estado',$filtros['estado']);
        }
        
        
        $sql->execute();
        $row = $sql->fetch();
        return $row['c'];
    }


    public function getMeusAnuncios(){
    global $pdo;   

    $array = array();



        $sql = $pdo->prepare("SELECT 
        *, 
        (select anuncios_imagens.url from anuncios_imagens where anuncios_imagens.id_anuncio
        = anuncios.id limit 1) as url from anuncios
        WHERE id_usuario = :id_usuario");
        $sql->bindValue(":id_usuario",$_SESSION['cLogin']);
        $sql->execute();

       
        
    if ($sql->rowCount() > 0){
        $array = $sql->fetchAll();
    }
    return $array;
    }

    public function getUltimosAnuncios(int $page , int $perPage, array $filtros){
        global $pdo;

    $offset = ($page - 1) * 2;

    $array = array();
    
    $filtrosString = array('1=1');
    
        if(!empty($filtros['categoria'])){
            $filtrosString[] = 'anuncios.id_categoria = :id_categoria';
        }

        if(!empty($filtros['preco'])){
            $filtrosString[] = 'anuncios.valor BETWEEN :preco1 AND :preco2';
        }

        if(!empty($filtros['estado'])){
            $filtrosString[] = 'anuncios.estado = :estado';
        }

            $sql = "SELECT 
            *, 
            (select anuncios_imagens.url from anuncios_imagens where 
            anuncios_imagens.id_anuncio = anuncios.id limit 1   ) as url,
            (select categoria.nome from categoria where categoria.id = anuncios.id_categoria
            ) as categoria
            FROM anuncios WHERE ".implode(' AND ',$filtrosString)." 
            ORDER BY id DESC LIMIT $offset, $perPage";

            
            $sql = $pdo->prepare($sql);;

            if(!empty($filtros['categoria'])){
                $sql->bindValue(':id_categoria',$filtros['categoria']);
            }

            if(!empty($filtros['preco'])){
            $preco = explode('-',$filtros['preco']);
            $sql->bindValue(':preco1',$preco[0]);
            $sql->bindValue(':preco2',$preco[1]);
            }   

            if(!empty($filtros['estado'])){
                $sql->bindValue(':estado',$filtros['estado']);
            }

    
        $sql->execute();
            
        if ($sql->rowCount() > 0){
            $array = $sql->fetchAll();    
        }
        return $array;
    }

    public function addAnuncio($titulo, $categoria , $valor , $descricao , $estado){
        try {
        global $pdo;
        $sql = $pdo->prepare("INSERT INTO anuncios  set
                            titulo       = :titulo , 
                            id_categoria = :id_categoria ,
                            id_usuario   = :id_usuario ,
                            descricao    = :descricao ,        
                            valor        = :valor , 
                            estado       = :estado ");

        $sql->bindValue(":titulo",$titulo);
        $sql->bindValue(":id_categoria",$categoria);
        $sql->bindValue(":id_usuario",$_SESSION['cLogin']);
        $sql->bindValue(":descricao",$descricao);
        $sql->bindValue(":valor",$valor);
        $sql->bindValue(":estado",$estado);
        $sql->execute();
     
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
     
    }
}
public function excluirAnuncio($id){
    global $pdo;

    $sql = $pdo->prepare("DELETE FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
    $sql->bindValue(":id_anuncio",$id);
    $sql->execute();

    $sql = $pdo->prepare("DELETE FROM anuncios WHERE id = :id");
    $sql->bindValue(":id",$id);
    $sql->execute();

}

public function getAnuncio($id){
    $array = array();
    global $pdo;

    $sql = $pdo->prepare("SELECT *,
    (select categoria.nome from categoria where categoria.id = anuncios.id_categoria
            ) as categoria,
    (select usuarios.telefone from usuarios where usuarios.id = anuncios.id_usuario
            ) as telefone
     FROM anuncios where id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();
    if($sql->rowCount() > 0){
        $array = $sql->fetch();
        $array['fotos'] = array();
        
        $sql = $pdo->prepare("SELECT id , url FROM anuncios_imagens WHERE id_anuncio = :id_anuncio");
        $sql->bindValue(":id_anuncio",$id);
        $sql->execute();
        if($sql->rowCount() > 0){
            $array['fotos'] = $sql->fetchAll();
        }

    }

    return $array;
}

public function editAnuncio($titulo, $categoria , $valor , $descricao , $estado ,$fotos, $id){
      
    try {
    global $pdo;
    $sql = $pdo->prepare("UPDATE  anuncios  set
                        titulo       = :titulo , 
                        id_categoria = :id_categoria ,
                        id_usuario   = :id_usuario ,
                        descricao    = :descricao ,        
                        valor        = :valor , 
                        estado       = :estado 
                        WHERE id = :id
                        ");

    $sql->bindValue(":titulo",$titulo);
    $sql->bindValue(":id_categoria",$categoria);
    $sql->bindValue(":id_usuario",$_SESSION['cLogin']);
    $sql->bindValue(":descricao",$descricao);
    $sql->bindValue(":valor",$valor);
    $sql->bindValue(":estado",$estado);
    $sql->bindValue(":id",$id);
    $sql->execute();
        
    $this->UploadImages($fotos,$id);
    

    }catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    }

    public function excluirFoto($id){
        global $pdo;
        $id_anuncio = 0;

        $sql = $pdo->prepare("SELECT id_anuncio from anuncios_imagens WHERE id = :id ");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $row = $sql->fetch();
            $id_anuncio = $row['id_anuncio'];
        }

        $sql = $pdo->prepare("DELETE  FROM anuncios_imagens where id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        return $id_anuncio;
        

    }
    
    public function UploadImages(array $fotos , $id_anuncio , $width=500, $height=500){
        global $pdo;
    if (count($fotos) > 0){
    
        for ($q = 0; $q < count($fotos['tmp_name']); $q++){
            $tipo = $fotos['type'][$q];
            if (in_array($tipo, array('image/jpeg', 'image/png')));
                $tmpname = md5(time().rand(0,9999)).'.jpg';
                move_uploaded_file($fotos['tmp_name'][$q],'assets/images/anuncios/'.$tmpname);
                list($width_origin , $height_origin) = getimagesize('assets/images/anuncios/'.$tmpname);
                $ratio = $width_origin / $height_origin;

                    if($width / $height > $ratio) {
                        $width = $height * $ratio;
                    } else {
                        $height = $width / $ratio;
                    }
                
                $img = imagecreatetruecolor($width,$height);

                if($tipo == 'image/jpeg'){
                    $origi = imagecreatefromjpeg('assets/images/anuncios/'.$tmpname);
                }elseif($tipo == 'image/png'){
                    $origi = imagecreatefrompng('assets/images/anuncios/'.$tmpname);
                }
                imagecopyresampled($img , $origi,0,0,0,0,$width,$height, $width_origin,$height_origin);
                imagejpeg($img,'assets/images/anuncios/'.$tmpname,80);

                $sql = $pdo->prepare("INSERT INTO anuncios_imagens SET id_anuncio = :id_anuncio , url = :url");
                $sql->bindValue(":id_anuncio",$id_anuncio);
                $sql->bindValue(":url",$tmpname);
                $sql->execute();
            }
        }
    }
}

