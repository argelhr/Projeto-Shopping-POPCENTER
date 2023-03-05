<body id="pagperfil">
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

        
        if(isset($_POST['codigo'])){

            $codproduto  = $_POST['codigo'];

            $sql = "SELECT produtos.* FROM PRODUTOS join lojas using (codloja) WHERE CODPRODUTO = ?";
            $array = array($codproduto);

            $produto = ConsultaSelect($sql,$array);

            ?>

                <h2 class="titulo">Editar Produto</h2>
                <div class="center">
                    <form class="form-cadastro" method="POST" action="../controllers/controller_produtos.php" enctype="multipart/form-data">

                        <input type="hidden" name="codproduto" value="<?php echo $codproduto?>">
                        <input type="hidden" name="codloja" value="<?php echo $produto['codloja']?>">


                        <label for="Nome">Nome do produto:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo $produto['nome']?>" placeholder="Informe aqui o nome do produto..." required>

                        <label for="Descrição do Produto">Descrição do Produto:</label>
                        <textarea  id="descricao" name="descricao" minlength="10"  placeholder="Informe aqui a descrição do produto..."><?php echo $produto['descricao']?></textarea>

                        <label for="preco">Preço:</label>
                        <input type="text" id="preco" name="preco" value="<?php echo str_replace(['.'],',', $produto['valor'])?>" placeholder="Informe aqui o preço..." pattern="[0-9,]+" required>

                        <label for="foto">Foto:</label>
                        <input type="file" name="foto" id="foto">
                        <br>
                        <input type="submit" name='botao' value="Editar Produto">
                    </form> 
                </div>
            <?php
        }

    ?>
</body>

<?php
    require_once('../includes/footer.php');
?>

<script>
    window.onload = function(){
        const preco = document.getElementById('preco');
        preco.addEventListener('keypress',validaTeclado)
        let btn = document.getElementById('btn')
        btn.addEventListener('click',menuShow)
    }

    function validaTeclado(event){
        let tecla = event.keyCode
        let preco = document.getElementById('preco');

        if(tecla == 44 && preco.value.includes(','))
            event.preventDefault();

        if(!(tecla>=48 && tecla<=57) && tecla != 44){
            event.preventDefault()
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















