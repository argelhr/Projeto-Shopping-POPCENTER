<link rel="stylesheet" href="./css/style.css">
<?php
    require_once('./controllers/funcoes_db.php');
    $token = $_GET['tk'];
    $email = $_GET['h'];

    $sql = 'select * from requisicao where md5(email) = ? and token = ?';
    $array = array($email,$token);

    $resultado = ConsultaSelect($sql,$array);

    if($resultado){
        ?>
        <body class="login">
            
            <form  id="login" action="./controllers/controller_usuario.php" method="post">

            <div style="margin:8px auto;">
                <img width="192px" src="./image/logo2.jpg" alt="">
            </div>
            
            <h2 class="titulo">Redefinir senha</h2>
                <input type="hidden" name="email"  value="<?php echo $email?>">
                <div>
                    <label for='Informe a nova senha'>Informe a nova senha:</label>
                    <input type="password" name="senha" required id="senha">
                </div>
                <div>
                    <label for="c_senha">Repita a senha:</label>
                    <input type="password" required id="c_senha">
                </div>
                <input type="submit" value="Redefinir Senha" name="botao">
            </form>
            
        </body>
     <?php
    }
    else{
        session_start();
        $_SESSION['msg'] = 'Link invalido';
        header('location:./login.php');
    }
?>
<script>
    window.onload = function(){
        let form = document.getElementById('form')
        form.addEventListener('submit',verificaSenhas) 
    }

    function verificaSenhas(){
        let senha = document.getElementById('senha')
        let c_senha = document.getElementById('c_senha')

        if(senha.value === c_senha.value)
            alert('senhas conferem')
        else{
            alert('senhas não conferem');
            event.preventDefault();
        }

    }
</script>