<body id="pagpesquisa">
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

        $codloja = $_POST['codloja'];
        
        $sql = 'select * from lojas where codloja = ?';
        $array = array($codloja);
        $loja = ConsultaSelect($sql,$array);

        $sql = 'select * from lojas join produtos using (codloja) join departamentos using (coddepartamento) where produtos.codloja = ?';
        $retorno = ConsultaSelectAll($sql,$array);

        if($retorno){
            ?>
            <h2 class="titulo"><?php echo $loja['nome']?></h2>
            <div class="container-user">
                <?php
                foreach($retorno as $prod){

                    $valor = str_replace(['.'],',', $prod['valor']);

                    ?>
                    <div class="card-user" >
                        <img src="http://localhost/POPCENTER/image/produtos/<?php echo $prod['foto'];?>" alt="<?php $prod['nome']?>">
                        <h2 class="card-title"><?php echo $prod['nome']?></h2>
                        <p class="card-price">R$ <?php echo $valor;?></p>
                        <form action="./pagina_prod.php" method="post">
                            <input type="hidden" name="codproduto" value="<?php echo $prod['codproduto']?>">
                            <input type="submit"  name="botao" value="Ver mais">


                        </form>
                        </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        else
            echo 'loja nao tem itens cadastrados';
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