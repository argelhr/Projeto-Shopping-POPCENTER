<link rel="stylesheet" href="./css/style.css">
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop center</title>
    
</head>


<body class="login">
    <form id="login" action="./controllers/controller_usuario.php" method="POST">
        <div style="margin:8px auto;">
            <img width="192px" src="./image/logo2.jpg" alt="">
        </div>
        <h2 class="titulo">Esqueceu Senha</h2>
        <label  for="email">Informe o seu email:</label>
        <input style="height: 30px;" type="text" name="email" required>
        <input type="submit" name='botao' value="Enviar">
    </form>
</body>


</html>

