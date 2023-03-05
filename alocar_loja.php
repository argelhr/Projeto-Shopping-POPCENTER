<body id="lojas">
    <?php
    require_once('./includes/header.php');
    require_once('./includes/menu-admin.php');
    require_once('./controllers/funcoes_db.php');

    $sql = 'select nr_loja from nr_lojas where ocupado is false';
    $numeros = ConsultaSelectAll($sql);
    
    $sql = "select * from pessoas where nivel like 'LOJISTA'";
    $lojistas = ConsultaSelectAll($sql);

    if($numeros){
        require_once('./includes/mensagem_sessao.php');
        ?>
        <form action="./controllers/controller_lojas.php" method="post">
            <h2 class="titulo">Escolha o número da loja:</h2>
            
            <div class="center">
                <div class="form-cadastro col-03">
                    <select  name="numero">
                        <?php   
                        foreach($numeros as $numero){
                        ?>
                            <option value="<?php echo $numero['nr_loja']?>"><?php echo $numero['nr_loja']?></option>
                            <?php
                        }
                    ?>
                    </select>
                </div>
            </div>
            <h2 class="titulo">Escolha o responsável:</h2>
            <div class="container-user">
                <?php
                    foreach($lojistas as $lojista){
                        ?>
                        <div class='card-user'>
                            
                            <img margin=top src="./image/users/<?php echo $lojista['foto']?>" alt="">
                            <div>Nome: <?php echo $lojista['nome']?></div>
                            <div>CPF: <?php echo $lojista['cpf']?></div>
                            <input type="radio" name="codigo" value="<?php echo $lojista['codpessoa'];?>">
                        </div>
                        <?php
                    }
                ?>
            </div>
            <div class="center">
                <div style="margin:20px" class="col-04">
                    <input type="submit"  name="botao" value="Alocar">
                </div>
            </div>
        </form>
        <?php
        }
        else{
            ?>
            <h2 class="titulo">Escolha o numero da loja</h2>
            <div class="center">
                <div id="mensagem">Não há lojas disponíveis</div>
            </div>
            <?php
        }
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