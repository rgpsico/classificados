<?php 
    require 'pages/header.php'; 
    require 'classes/anuncios.class.php';
    require 'classes/usuario.class.php';
    require 'classes/categoria.class.php';

    $a = new anuncios();
    $u = new Usuario();
    $c = new Categorias();

    $filtros = array(
        'categoria' =>'',
        'preco' => '',
        'estado'=>''
);

if(isset($_GET['filtros'])){
    $filtros = $_GET['filtros'];
}


  $total_anuncios = $a->getTotalAnuncios($filtros);
  $total_usuarios = $u->getTotalUsuarios();

$pagination = 1;
if(isset($_GET['p']) && !empty($_GET['p'])){
    $pagination = addslashes($_GET['p']);
}
$por_pagina  = 2;

$total_paginas = ceil($total_anuncios / $por_pagina);

$anuncios = $a->getUltimosanuncios($pagination, $por_pagina , $filtros);
$categoria = $c->getLista();

$PrecoDe0A50    = "";
$PrecoDe50A100  = "";
$PrecoDe101A200 = "";
$PrecoDe201A300 = "";


switch ($filtros['preco']) {
  case "0-50":
      $PrecoDe0A50  = "selected='selected'";
      break;
  case "51-100":
      $PrecoDe50A100  = "selected='selected'";
      break;

  case "101-200":
      $PrecoDe101A200  = "selected='selected'";
      break;

  case "201-300":
      $PrecoDe201A300  = "selected='selected'";
  break;                        
}


$ruim  = "";
$bom = "";
$otimo = "";
switch ($filtros['estado']) {
    case "0":
        $ruim  = "selected='selected'";
        break;
    case "1":
        $bom  = "selected='selected'";
        break;
    case "2":
        $otimo  = "selected='selected'";
        break;                       
}

?>
    <div class="container-fluid">
        <div class="jumbotron">
            <h2>Nós temos hoje <?=$total_anuncios ?> anúncios</h2>
            <p>e mais de <?=$total_usuarios ?> usuarios cadastrados</p>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <h3>Pesquisa avançada</h3>
                <form action="" method="GET">
                    <div class="form-group">
                    <label for="categoria">Categoria:</label>
                        <select id="categoria" name="filtros[categoria]" class="form-control" id="">
                            <?php foreach($categoria as $cat){
                                $catSelect = ($cat['id'] == $filtros['categoria'] ? 'selected="selected"' : "");
                                ?>
                             
                            <option value="<?php echo $cat['id'] ?>" <?= $catSelect;?>><?php echo utf8_decode($cat['nome']) ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <?php 
                    
                ?>
                    <div class="form-group">
                    <label for="preco">Preço:</label>
                        <select id="preco" name="filtros[preco]" class="form-control" id="preco">
                        <option value="0-50"   <?= $PrecoDe0A50?>>R$ 0 - 50</option>
                        <option value="101-200" <?= $PrecoDe101A200?>>R$101 - 200</option>
                        <option value="201-300" <?= $PrecoDe201A300?>>R$201 - 300</option>
                        </select>
                    </div>

                    <div class="form-group">
                    <label for="estado">Estado de conservação:</label>
                    <select id="estado" name="filtros[estado]" class="form-control" id="estado">
                        <option value="0" <?= $ruim?>>Ruim</option>
                        <option value="1" <?= $bom?>>Bom</option>
                        <option value="2" <?= $otimo?>>Ótimo</option>
                    </select>
                    </div>
                
                    <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Buscar">
                    </div>
                </form>

            </div>
            
            <div class="col-sm-9">
                <h3>Ultimos Anúncios</h3>
            <table class="table table-striped">
                <?php 
                foreach($anuncios as $anuncio){ 
                    $img  = ($anuncio['url'] == "" ? "default.png" :$anuncio['url'] );
                    ?> 
                
                <tr>
                <td><img src="assets/images/anuncios/<?php echo $img ?>" width="100px" height="100px"alt=""></td>
                
                <td>
                    <a href="produto.php?id=<?php echo $anuncio['id']; ?>">
                        <?php echo $anuncio['categoria'] ?></a>
                    <br/>
                    <?php utf8_encode($anuncio['categoria']); ?>
                </td>
                <td><?php echo $anuncio['titulo'] ?></td>
                <td><?php echo number_format($anuncio['valor'],2) ?></td>
                </tr>
                <?php }?>  
             </table>

            <ul class="pagination">
            <?php 
            
            for($q=0; $q<=$total_paginas; $q++){
                $w = $_GET;
                $w['p'] = $q ;
                $linkCompleto = http_build_query($w);
                ?>
                <li class="<?php echo ($pagination == $q)? 'active' : '' ?>">
                <a href="index.php?<?= $linkCompleto ?>"><?= $q ?></a></li>
            <?php } ?>
            </ul>
            </div>
        </div>
    </div>
<?php require 'pages/footer.php' ?>