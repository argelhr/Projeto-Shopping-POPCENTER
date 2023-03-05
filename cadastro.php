<link rel="stylesheet" href="./css/style.css">
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pop Center</title>
    </head>

    <body class="cadastro">
        <form id="cadastro" action="./controllers/controller_usuario.php" method="post">
            <div style="margin:0 auto;"> <img width="192px" src="./image/logo2.jpg" alt=""></div>
            <label c for="Nome">Nome:</label>
            <input type="text" name="nome" required>

            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id='cpf'required pattern="[0-9.-]*">

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" id="telefone" pattern="[()0-9-]*">

            <label for="dt_nasc">Data de Nascimento:</label>
            <input type="date" name="dt_nasc" required>

            <label for="senha">Senha:</label required>
            <input type="password" name="senha" id="senha">

            <label for="c_senha">Confirmação de senha:</label>
            <input type="password" id="c_senha" required>
            
            <label style="display:flex;gap: 10px;" for="promocao"><input type="checkbox" value='true' name="promocao">Deseja receber atualização via email?</label>
            

            <input type="submit" value="Cadastrar" name="botao">

            <div style=" padding: 16px;">Possui cadastro? Faça o login<a href="login.php" style="color:red"> clicando aqui</a></div>
            <div style="color: red; font-weight:bold;">
            <?php
                if(isset($_SESSION['msg']))
                { 
                    echo "Mensagem: ".$_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
            ?>
        </div>
        </form>
        
        
    </body>

</html>

<script src="./js/cadastro.js"></script>