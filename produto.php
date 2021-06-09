<?php require 'pages/header.php'; 
      require 'classes/anuncios.class.php';
      require 'classes/usuario.class.php';
    $a = new anuncios();
    $u = new Usuario();

    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = addslashes($_GET['id']);
    }else{
       
        echo "<script>window.location.href='login.php';</script>";
        exit;
    }
    $info = $a->getAnuncio($id); 
    
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
            <div class="carousel slide" data-ride="carousel" id="meuCarousel">
                <div class="carousel-inner" role="listbox">
                    <?php foreach($info['fotos'] as $chave=> $foto): ?>
                    <div class="item <?php echo ($chave == "0" ? 'active' :'');?>">
                        <img src="assets/images/anuncios/<?php echo $foto['url']; ?>" alt=""/>
                    </div>
                
                    <?php endforeach; ?>
                </div>
                    <a class="left carousel-control" href="#meuCarousel" role="button"
                    data-slide="prev">
                    <span><</span></a>

                    <a class="right carousel-control" href="#meuCarousel" role="button"
                    data-slide="next">
                    <span>></span></a>
                </div>
            
            </div>
            <div class="col-sm-7">
            <h1><?= utf8_decode($info['titulo']) ?></h1>
            <h4><?= utf8_decode($info['categoria']) ?></h4>
            <p><?= utf8_decode($info['descricao']) ?></p>
            <br/>
            <h3>R$ <?= number_format($info['valor'],2) ?> </h3>
            <h4>Telefone: <?= $info['telefone'] ?> </h4>
            </div>
        </div>
    </div>
<?php require 'pages/footer.php' ?>