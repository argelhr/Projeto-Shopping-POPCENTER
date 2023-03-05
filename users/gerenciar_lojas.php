
<body id='pagperfil'>
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

        if($_SESSION['nivel'] != 'LOJISTA')
            header('location:../index.php');
        
        $sql = "SELECT lojas.*,descricao 
                FROM lojas left JOIN departamentos using (coddepartamento) 
                WHERE lojas.codpessoa = ?";

        $array = array($_SESSION['codpessoa']);

        $lojas = ConsultaSelectAll($sql,$array);
?>

    <h2 class="titulo">Lojas</h2>

    <?php
        require_once('../includes/mensagem_sessao.php');
    ?>

    <div class="container">

    <?php

        foreach($lojas as $loja){
            ?>
            <div class="card-loja">
                <img src="../image/lojas/<?php echo $loja['foto']?>" alt="<?php echo $loja['nome'];?>">
                <div >

                    <div class="card-title">
                        <?php echo $loja['nome']?>
                    </div>


                    <form action="./alterar_foto_loja.php" method="post">
                        <input type="hidden" name="codigo" value="<?php echo $loja['codloja'];?>">
                        <input type="submit" value="Alterar Foto">
                    </form>

                    <form action="./alterar_dados.php" method="post">
                        <input type="hidden" name="codigo" value="<?php echo $loja['codloja'];?>">
                        <input type="submit" value="Alterar Dados">
                    </form>

                    <form action="./adicionar_produto.php" method="post">
                        <input type="hidden" name="codigo" value="<?php echo $loja['codloja'];?>">
                        <input type="hidden" name="nome" value="<?php echo $loja['nome'];?>">
                        <input type="submit" value="Cadastrar Produto">
                    </form>

                    <form action="./editar_produtos.php" method="post">
                        <input type="hidden" name="codigo" value="<?php echo $loja['codloja'];?>">
                        <input type="submit" value="Editar Produtos">
                    </form>

                </div>
            </div>
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