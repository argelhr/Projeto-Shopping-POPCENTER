<body id="pagperfil">
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');
        $sql = 'select * from lojas where codloja = ?';
        $array = array($_POST['codigo']);
    ?>
    <h2 class="titulo">Alterar Foto da Loja</h2>

    <div class="center">
        <form class="form-cadastro" method="POST" action="../controllers/controller_lojas.php" enctype="multipart/form-data">
            <input type="hidden" name="codloja" value="<?php echo $_POST['codigo'];?>">
            <h3 >Selecione a foto:</h3>
            <input type="file" id="arquivo" name="arquivo" required/>
            <input type="submit" name="botao" value="Alterar Foto">
        </form>
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
