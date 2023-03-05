<body id="pagpesquisa">
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

        $codproduto = $_POST['codproduto'];

        $sql = "SELECT produtos.*, lojas.nome as lojaa from produtos join lojas using(codloja) where codproduto = ?";
        $array = array($codproduto);

        $produto = ConsultaSelect($sql,$array);
        if($produto){
        
            ?>

            <h2 class="titulo"><?php echo $produto['lojaa'];?> </h2>

            <div class="center">
                <div class="perfil-prod col-10">
                    
                    <div class="center">
                        <img src="../image/produtos/<?php echo $produto['foto']?>" alt="">
                    </div>
            
            
            
                    <div >
                        <h3 class='titulo' style="margin:20px"><?php echo $produto['nome']?></h3>
                        <div class="perfil-box">
                            <div class="cart-text"><?php echo $produto['descricao']?></div>
                            <div> R$ <?php echo $produto['valor']?></div>
                            <form action="../controllers/controller_usuario.php" method="post">
                                <input type="hidden" name="codproduto" value="<?php echo $codproduto?>">
                                <input type="number" name="qtd" value="1">
                                <input type="submit" name='botao' value="Adicionar">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <?php
    }
        else
            header('location:../index.php');
    ?>
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