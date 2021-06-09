<?php require 'pages/header.php'; ?>
    <div class="container">
    <h1>Cadastre-se</h1>
    <?php 
        require 'classes/usuario.class.php';
        $Usuario = New Usuario();
        if(isset($_POST['nome']) && !empty($_POST['nome'])){
            $nome      = addslashes($_POST['nome']);
            $email     = addslashes($_POST['email']);
            $senha     = addslashes($_POST['senha']);
            $telefone  = addslashes($_POST['telefone']);

                if(!empty($nome) && !empty($email) && !empty($senha)){
                    if($Usuario->cadastrar($nome , $email , $senha , $telefone)){ 
                    ?>
                        <div class="alert alert-success">
                           <strong>Parabéns</strong>
                           Cadastrado com sucesso
                           <a href="login.php" class="alert-link">Faça o Login agora</a>
                        </div>
                    <?php  
                    }else {
                        ?>

                        <div class="alert alert-warning">
                        Este usuario já existe
                        <a href="login.php" class="alert-link">Faça o Login agora</a>
                        </div>
               <?php
                    }
                } else {
                    ?> 
                    <div class="alert alert-warning">
                        Prencha todos os campos
                    </div>
            <?php 
                }  
            }
            
    ?>
    <form method="POST">
        <div class="form-group">
            <label for="nome">Seu Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="email">Seu Email:</label>
            <input type="text" name="email" id="email" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="senha">senha:</label>
            <input type="text" name="senha" id="senha" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="telefone">telefone:</label>
            <input type="text" name="telefone" id="telefone" class="form-control"/>

        </div>
        <input type="submit" value="cadastrar" name="cadastrar" class="btn btn-default">

    </form>
    </div>
<?php require 'pages/footer.php' ?>