<link rel="stylesheet" href="./css/style.css">
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pop Center</title>
        
    </head>
    
    <?php
        session_start();
    ?>
    <body class="login">
        <form id="login" action="./controllers/controller_usuario.php" method="post">

            <div style="margin:8px auto;">
                <img width="192px" src="./image/logo2.jpg" alt="">
            </div>
            
            <h2 class="titulo">Login</h2>

            <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="ex:maria@gmail.com" required>
            
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" placeholder="Informe aqui sua senha..." required>
            
            <input type="submit" name="botao" value="Logar">

            <a style="padding: 24px 0 8px 0;" href="esqueceu_senha.php">Esqueceu a senha?</a>
            <div style="padding: 8px 0 8px 0;">Não tem cadastro? <a href='./cadastro.php'>Cadastre-se!</a></div>

            <div style="color: red; font-weight:bold" id="msg">

                <?php
                    if(isset($_SESSION['msg'])){
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                        session_destroy();
                    }
                ?> 
            </div>
        </form>



</body>