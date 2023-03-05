<body id="pagperfil">

    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

        if(isset($_POST['codigo']))
            $codloja = $_POST['codigo'];
        else{
            $codloja = $_SESSION['codloja'];
            unset($_SESSION['codloja']);
        }
    ?>
    <h2 class="titulo">Editar Produtos</h2>
    <?php

        require_once('../includes/mensagem_sessao.php');

        $sql = 'select * from produtos where codloja = ?';
        $array = array($codloja);

        $produtos = ConsultaSelectAll($sql,$array);
    ?>
    <div class="container-user">
        <?php
        foreach($produtos as $produto){
            ?>
            <form class="card-user" action="./editar_prod.php" method="post">
            
                <input type="hidden" name="codigo" value="<?php echo $produto['codproduto']?>">
                
                <img src="../image/produtos/<?php echo $produto['foto']?>" alt="">
                <div class="card-title"><?php echo $produto['nome']?></div>
                <div class="card-text">Preço: R$ <?php echo $produto['valor']?></div>
                <input type="submit" name="botao" value="Editar Produto">
            </form>
            <?php
        }
        ?>
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