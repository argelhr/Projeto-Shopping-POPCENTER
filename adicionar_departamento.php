
<body id="departamentos">
    <?php 
        require_once('./includes/header.php');
        require_once('./includes/menu-admin.php');
    ?>

    <h2 class="titulo">Departamentos</h2>

    <div class="center">
        <form class="form-cadastro col-06" action="./controllers/controller_lojas.php" method="post">
            <label for="nome">Nome do departamento:</label>
            <input type="text" name="nome" required>
            <input type="submit" name="botao" value="Adicionar Departamento" placeholder="Digite aqui o nome do departamento...">
        </form>
    </div>
    <?php 
        require_once('./includes/mensagem_sessao.php');
    ?>
</body>


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