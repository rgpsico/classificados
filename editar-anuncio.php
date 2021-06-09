<?php 
require 'pages/header.php';
if(empty($_SESSION['cLogin'])){
    echo "<script>window.location.href='login.php';</script>";
    exit;
 
}

require 'classes/anuncios.class.php';
$a = new Anuncios();
if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
    $titulo    = addslashes($_POST['titulo']);
    $categoria = addslashes($_POST['categoria']);
    $valor     = addslashes($_POST['valor']);
    $descricao = addslashes($_POST['descricao']);
    $estado    = addslashes($_POST['estado']);
    if(isset($_FILES['fotos'])){
        $fotos = $_FILES['fotos'];
    }else {
        $fotos = array();
    }

    $a->editAnuncio($titulo, $categoria , $valor , $descricao , $estado ,$fotos, $_GET['id']);

}
?>
<div class="alert alert-success">
    Produto editado com sucesso!
</div>

<?php  
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id =  $_GET['id'];
    $info = $a->getAnuncio($id);
}else {
echo "<script>window.location.href='meus-anuncios.php';</script>";
}
?>
<div class="container">
        <h1>Meus Anuncios -  editar Anuncios</h1>
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria" class="form-control">
                <?php 
                require 'classes/categoria.class.php';
                $c = new Categorias();
                $cats = $c->getLista();
                foreach($cats as $cat){
                ?>
                <option value="<?php echo $cat['id']; ?>"
                    <?php echo ($info['id_categoria'] == $cat['id']) ? 'selected="selected"' : ''  ?>>
                <?php echo utf8_encode($cat['nome']); ?>
                
                </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo utf8_encode($info['titulo']) ?>">
        </div>

        <div class="form-group">
            <label for="Valor">Valor:</label>
            <input type="text" name="valor" id="valor" class="form-control" value="<?php echo utf8_encode($info['valor']) ?>">
        </div>

        <div class="form-group">
            <label for="descricao">Descricao:</label>
        <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="10"><?php echo utf8_encode($info['descricao']) ?></textarea>
        </div>
                    <?php
                     $bom = "";
                     $ruim = "";
                     $otimo = "";
                    switch ($info['estado']) {
                        case 0:
                           $ruim = " selected='selected'";
                        break;
                        case 1:
                            $bom =  " selected='selected'";
                        break;

                        case 2:
                            $otimo =  " selected='selected'";
                        break;
                    }
                    ?>
        <div class="form-group">
            <label for="estado">Estado de conservação:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0">Ruim</option>
                <option value="1" <?php echo $bom ?>>Bom</option>
                <option value="2"<?php echo $otimo ?>>Ótimo</option>
            </select>
        </div>

        <div class="form-group">
        <label for="add_foto">Fotos do Anuncios</label>
        <input type="file" name="fotos[]" multiple>

        <div class="panel panel-default">
            <div class="panel-heading">Fotos anuncios:</div>
            <div class="panel-body">
            <?php foreach($info['fotos'] as $foto): ?>
            <div class="foto_item">
                <img src="assets/images/anuncios/<?php echo $foto['url']; ?>" class="img-thumbnail">
                <br/>
                <a href="excluir-fotos.php?id=<?php echo $foto['id']; ?>" class="btn btn-default">Excluir imagem</a>
            </div>
                    
            <?php endforeach; ?>
            </div>
            </div>
        </div>
        
        <input type="submit" value="Salvar" name="Salvar">
        </form>
</div>

<?php require 'pages/footer.php' ?>