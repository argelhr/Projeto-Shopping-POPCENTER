<body id="pagperfil">
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

        if(isset($_POST['codigo']))
            $codigo = $_POST['codigo'];
        else{
            $codigo = $_SESSION['codloja'];
            unset($_SESSION['codloja']);
        }

        if(isset($_POST['nome']))
            $nome = $_POST['nome'];
        else{
            $nome = $_SESSION['nome'];
            unset($_SESSION['nome']);
        }
    ?>

    <h2 class="titulo">Adicionar produto</h2>
    <?php
        require_once('../includes/mensagem_sessao.php');
    ?>

    <div class="center">
        <form class="form-cadastro" method="POST" action="../controllers/controller_produtos.php" enctype="multipart/form-data">

            <input type="hidden" name="codloja" value="<?php echo $codigo?>">
            <input type="hidden" name="nomeloja" value="<?php echo $nome?>">

            <div class="card-title titulo">
                <?php echo $nome;?>
            </div>

            <label for="Nome">Nome do produto:</label>
            <input type="text" id="nome" name="nome" placeholder="Informe aqui o nome do produto..." required>

            <label for="Descrição do Produto">Descrição do Produto:</label>
            <textarea  id="descricao" name="descricao" minlength="10" placeholder="Informe aqui a descrição do produto..."></textarea>

            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco" placeholder="Informe aqui o preço..." pattern="[0-9,]+" required>

            <label for="foto">Foto:</label>
            <input type="file" name="foto" id="foto">
            <br>
            <input type="submit" name='botao' value="Cadastrar Produto">
        </form> 

    </div>
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














