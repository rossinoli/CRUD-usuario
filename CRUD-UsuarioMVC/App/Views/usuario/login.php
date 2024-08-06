
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="http://<?php echo APP_HOST; ?>/public/css/bootstrap.min.css">
    
</head>
<body class="text-center">
    <?php
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }
    unset($_SESSION['mensagem']);
   
    ?>
    <div class="container border  border-dark-subtle mt-5" style="width:350px">
        <h2>Login</h2>
        <form action="http://<?php echo APP_HOST; ?>/usuario/logar" method="post">
            <img class="mb-2" src="imagens/CrudLogo.png" style="width:134px;height:86px;" alt="CRUD_logo">
            <div class="form-row align-items-center " style="margin-right: 8px;">
                <i class="fas fa-user col-2" style="margin-bottom:20px; font-size:25px;color:#012060;"></i>
                <input type="text" name="login"
                    value=""
                    class="form-control col-10" style="margin-bottom:20px; font-size:16px;" placeholder="Digite o Login" required
                    autofocus>
            </div>
            <div class="form-row align-items-center" style="margin-right: 8px;">
                <i class="fas fa-lock col-2" type="icon" style="margin-bottom:30px; font-size:25px;color:#012060;"></i>
                <input type="password" name="senha" class="form-control col-10" style="margin-bottom:30px;"
                    placeholder="Digite a senha" required>
            </div>
    <div class="form-row align-items-center mb-3" >
      <button class="btn btn-lg btn-outline-warning btn-block btn-hover" style="margin-left:15px; margin-right: 10px;"
        type="submit">Entrar</button>
    </div>
    
        </form>
    </div>
</body>
</html>
