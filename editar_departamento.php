<body id="departamentos">
    <?php 
        require_once('./includes/header.php');
        require_once('./includes/menu-admin.php');
        require_once('./controllers/funcoes_db.php');

        $codigo = $_POST['codigo'];
        $sql = 'select * from departamentos where coddepartamento = ?';
        $linha = ConsultaSelect($sql,array($codigo));
    ?>

    <h2 class="titulo">Editar Departamento</h2>

    <?php 
        require_once('./includes/mensagem_sessao.php');
    ?>    
    
    <div class="center">
        <form class="form-cadastro col-04" action="./controllers/controller_lojas.php" method="post">
            <input type="hidden" name="codigo" value="<?php echo $linha['coddepartamento'];?>">
            <label for='coddepartamento'>Código: <?php echo $linha['coddepartamento'];?></label>
            
            <label for="nome">Descrição:</label>
            <input type="text" name="nome" value="<?php echo $linha['descricao'];?>" required>
            <div>Status:
                <select name="status">
                    <option value="0" <?php if(!$linha['ativo'])echo 'selected';?> >Desativada</option>
                    <option value="1" <?php if($linha['ativo'])echo 'selected';?> >Ativo</option>
                </select>
            </div>
            <input type="submit" name="botao" value="Editar Departamento">
        </form>
    </div>
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