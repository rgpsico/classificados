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


    $a->addAnuncio($titulo, $categoria , $valor , $descricao , $estado);

}
?>
<div class="alert alert-success">
    Produto Adicionado com sucesso!
</div>
<div class="container">
        <h1>Meus Anuncios -  adicionar Anuncios</h1>
        <form action="add-anuncios.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria" class="form-control">
                <?php 
                require 'classes/categoria.class.php';
                $c = new Categorias();
                $cats = $c->getLista();
                foreach($cats as $cat){
                ?>
                <option value="<?=$cat['id'] ?>"><?=$cat['nome'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="titulo">Titulo:</label>
            <input type="text" name="titulo" id="titulo" class="form-control">
        </div>

        <div class="form-group">
            <label for="Valor">Valor:</label>
            <input type="text" name="valor" id="valor" class="form-control">
        </div>

        <div class="form-group">
            <label for="descricao">Descricao:</label>
        <textarea class="form-control" name="descricao" id="descricao" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado de conservação:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0">Ruim</option>
                <option value="1">Bom</option>
                <option value="2">Ótimo</option>
            </select>
        </div>
        
        <input type="submit" value="Adicionar" name="Adicionar">
        </form>
</div>

<?php require 'pages/footer.php' ?>