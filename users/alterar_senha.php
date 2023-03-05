<body id="pagperfil">
<?php
    require_once('../includes/header.php');
    require_once('../includes/menu-user.php');
    require_once('../controllers/funcoes_db.php');

    $sql = 'SELECT * from pessoas where codpessoa = ?';
    $array = array($_SESSION['codpessoa']);

    $dados = ConsultaSelect($sql,$array);

    ?>
        <h2 class="titulo">Alterar Senha</h2>
        <?php
            require_once('../includes/mensagem_sessao.php');
        ?>
        <div class="center">
            <form id="cadastro" class="form-cadastro col-03" action="../controllers/controller_usuario.php" method="post">
                <label for="senha_antiga">Senha Antiga:</label>
                <input type="password" name="senha_antiga" required>
                
                <label for="senha:">Senha Nova:</label>
                <input type="password" name="senha" id="senha" required>

                <label for="c_senha">Confirmação de Cenha:</label>
                <input type="password" id="c_senha" required>

                <input type="hidden" name="codpessoa" value="<?php echo $_SESSION['codpessoa']?>">
                <input type="submit" name="botao" value="Alterar Senha">
            </form>
        </div>

</body>

<?php
    require_once('../includes/footer.php');
?>

<script>
    window.onload = function(){
        let formulario = document.getElementById('cadastro')
        formulario.addEventListener('submit',verificaForm)
        
        let btn = document.getElementById('btn')
        btn.addEventListener('click',menuShow)
    }

    function verificaForm(event){
        let senha = document.getElementById('senha').value
        let c_senha = document.getElementById('c_senha').value
        
        if(senha.length < 6){
            alert('Senha pequena. Digite uma senha com pelo menos seis digitos')
            event.preventDefault()
        }
        
        if(senha === c_senha){
            console.log('senhas conferem')
        }
        else{
            alert('Campos de senhas estão incompatíveis')
            event.preventDefault()
            return false
        }
    }

    window.onresize = start;//evento de mudança de tamanho de tela

    function menuShow() {
        let menuMobile = document.getElementById('menuzin');
        if(menuMobile.classList.contains('close')){
            menuMobile.classList.remove('close')
            menuMobile.classList.add('open')
        }
        else{
            menuMobile.classList.remove('open')
            menuMobile.classList.add('close')
        }
    }

    function start(){
        let tela = document.documentElement.clientWidth;
        let menuMobile = document.getElementById('menuzin');
        if(tela>820){
            menuMobile.classList.remove('close')
            menuMobile.classList.remove('open')
            menuMobile.classList.add('close')
        }
    }
</script>