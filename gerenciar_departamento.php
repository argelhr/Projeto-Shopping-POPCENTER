<body id="departamentos">
    <?php 
        require_once('./includes/header.php');
        require_once('./includes/menu-admin.php');
        require_once('./controllers/funcoes_db.php');

        $sql = "select * from departamentos";
        $departamentos = ConsultaSelectAll($sql);

        if($departamentos){
        ?>
            <h2 class="titulo">Departamentos</h2>:
            <div style="display: flex; justify-content:center;">
            <table style="margin:20px" class="col-08">
                <tr class="tr">
                    <thead>
                        <th class="tabela">Código</th>
                        <th class="tabela">Descrição</th>
                        <th class="tabela">Status</th>
                        <th class="tabela">Função</th>
                    </thead>
                </tr>
            <?php
            foreach($departamentos as $departamento){
                ?>
                <tr>
                    <td><?php echo $departamento['coddepartamento']?></td>
                    <td><?php echo $departamento['descricao']?></td>
                    <td><?php echo $departamento['ativo']?></td>
                    <td>
                        <form action="editar_departamento.php" method="post">
                        <input type="hidden" name="codigo" value="<?php echo $departamento['coddepartamento']?>">
                        <input type="submit" name="botao" value="Editar">
                        </form>
                    </td>   
                </tr>
                <?php
            }
            ?>
        
            </table>
            </div>
        <?php
        }else
        {
            ?>
            <h2 class="titulo">Departamentos</h2>:
            <div class="center">
                <div id="mensagem">
                    Não há departamentos registrados
                </div>
            </div>
            <?php
        }


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