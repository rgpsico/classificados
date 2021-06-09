<?php 
require 'pages/header.php';
if(empty($_SESSION['cLogin'])){
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

?>
<div class="container">
        <h1>Meus Anuncios</h1>
        <a href="add-anuncios.php" class="btn btn-success">Adicionar anuncios</a>
  
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>titulo</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php
        require 'classes/anuncios.class.php';
            $a = new Anuncios();
            $anuncios = $a->getMeusAnuncios();
            foreach($anuncios as $anuncio){
            $img  = ($anuncio['url'] == "" ? "default.png" :$anuncio['url'] )
        
        ?>
            <tr>
                <td><img src="assets/images/anuncios/<?php echo $img ?>" width="100px" height="100px"alt=""></td>
                <td><?php echo $anuncio['titulo'] ?></td>
                <td><?php echo number_format($anuncio['valor'],2) ?></td>
                <td><a class="btn btn-info" href="editar-anuncio.php?id=<?php echo $anuncio['id'] ?>">Editar</a>
                    <a class="btn btn-danger" href="excluir-anuncio.php?id=<?php echo $anuncio['id'] ?>">Excluir</a>
                </td>
        </tr>
        <?php } ?>
        </tbody>
    
    </table>
</div>
<?php require 'pages/footer.php' ?>