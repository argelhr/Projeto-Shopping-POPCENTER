<body id="pagperfil">
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

        $sql = "select * from pessoas left join enderecos using (codpessoa) where codpessoa = ?";
        $array = array($_SESSION['codpessoa']);

        $dados = ConsultaSelect($sql,$array);

        $dt_nasc = new DateTime($dados['dt_nasc']);
        $resultado = $dt_nasc->diff( new DateTime( date('Y-m-d') ) );
        $dt_nasc = $dt_nasc->format('d/m/y');
        $idade = $resultado->format( '%Y anos' );
    ?>

    <h2 class="titulo">Perfil</h2>

    <?php
        require_once('../includes/mensagem_sessao.php');
    ?>


    <div class="user">
        <div class="perfil">
            <div>
                <img class="foto" src="../image/users/<?php echo $dados['foto']?>">
            </div>
            <div class="informacoes">
                <h1><?php echo $dados['nome']?></h1>
                <div>Nível: <?php echo $dados['nivel'] ?></div>
                <div>CPF:<?php echo $dados['cpf'] ?></div>
                <div>Idade: <?php echo $idade ?></div>
                <div>Email:<?php echo $dados['email'] ?></div>
                <form action="./alterar_dados_user.php" method="post">
                    <input type="submit" value="Alterar Dados" name="botao">
                </form>
                <form action="./alterar_senha.php" method="post">
                    <input type="submit" value="Alterar Senha" name="botao">
                </form>
            </div>
                <div class="informacoes">
                    <h1>Endereço</h1>
                    <?php
                        if(!isset($dados['codendereco'])){
                            echo "<div>Você não tem endereço cadastrado</div>";
                        }
                        else{
                            ?>
                            <div>UF: <?php echo $dados['uf']?></div>
                            <div>Cidade: <?php echo $dados['cidade']?></div>
                            <div>CEP: <?php echo $dados['cep']?></div>
                            <div>Bairro: <?php echo $dados['bairro']?></div>
                            <div>Rua: <?php echo $dados['rua']?></div>
                            <div>Número: <?php echo $dados['numero']?></div>
                            <?php
                            if($dados['complemento']){
                                ?>
                                <div>Complemento: <?php echo $dados['complemento']?></div>
                                <?php
                            }
                        }
                    ?>
                    <form action="./alterar_endereco.php" method="post">
                        <input type="submit" value="Alterar Endereco">
                    </form>
                </div>
            
                
            </div>
    </div>
</body>

<?php
    require_once('../includes/footer.php');
?>

<script>

    window.onresize = start;//evento de mudança de tamanho de tela

    window.onload = function(){
        let btn = document.getElementById('btn')
        btn.addEventListener('click',menuShow)
    }


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