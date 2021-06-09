<?php require 'pages/header.php'; ?>
    <div class="container">
    <h1>Login</h1>
    <?php 
        require 'classes/usuario.class.php';
        $Usuario = New Usuario();
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email     = addslashes($_POST['email']);
            $senha     = $_POST['senha'];

            if($Usuario->login($email,$senha)) {
                echo "<script>window.location.href='./';</script>";


            }else {
                ?>
                <div class="alert alert-danger">
                    Usuario e/ou Senha errados!
                </div>

    <?php
            }
        }
        

    ?>
    <form method="POST">
    
        <div class="form-group">
            <label for="email">Seu Email:</label>
            <input type="text" name="email" id="email" class="form-control"/>
        </div>

        <div class="form-group">
            <label for="senha">senha:</label>
            <input type="text" name="senha" id="senha" class="form-control"/>
        </div>
        <input type="submit" value="Fazer login" name="cadastrar" class="btn btn-default">

    </form>
    </div>
<?php require 'pages/footer.php' ?>