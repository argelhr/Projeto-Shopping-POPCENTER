<body id='sacola'>
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

        $sql = 'SELECT codsacola from sacola where codpessoa = ?';
        $array = array($_SESSION['codpessoa']);
        $resultado = ConsultaSelect($sql,$array);
        ?>

        <h2 class="titulo">Sacola</h2>

        <?php

        require_once('../includes/mensagem_sessao.php');

        if(!($resultado)){
            ?>
            <div style="display:flex; flex-direction:column; align-items:center">
                        <div>
                            <img style="mix-blend-mode: multiply;" src="../image/sacolaaa.png" alt="">
                        </div>
                        <div>Não há produtos na sacola</div>
                    </div>
            <?php
        }
        else{
            
            $codsacola = $resultado['codsacola'];
            // pra pegar os codigos das lojas que tem itens na sacola pra esse usuario
            $sql = 'SELECT DISTINCT(codloja),lojas.nome from sacola_itens join produtos using(codproduto) join lojas using (codloja)
                where codsacola = ?
                and lojas.ativo is true
                and produtos.ativo is true';
            $array = array($codsacola);
            $codlojas = ConsultaSelectAll($sql,$array);

            if(!($codlojas)){
                ?>
                    <div style="display:flex; flex-direction:column; align-items:center">
                        <div>
                            <img style="mix-blend-mode: multiply;" src="../image/sacolaaa.png" alt="">
                        </div>
                        <div>Não há produtos na sacola</div>
                    </div>
                <?php
            }

            
           //pra pegar informações dos itens que tem na sacola

            foreach($codlojas as $codloja){

                $sql = 'select produtos.*,qtd from produtos natural join sacola_itens where codsacola = ? and codloja = ?';
                $array = array($codsacola,$codloja['codloja']);
                $aux = ConsultaSelectAll($sql,$array);
                ?>

                <form method="post" id='form' action="../controllers/controller_usuario.php" class="sacola-loja">
                    
                    <h3><?php echo $codloja['nome'];?></h3>
                    <input type="hidden" name="" id="titulo" value="<?php echo $codloja['nome'];?>">

                    <table class="sacola-items">
                        <tr style="border-top: 1px solid #666;">
                            <th>+</th>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th style="margin: 8px;">Valor</th>
                        </tr>
                         
                        <?php
                        
                        foreach($aux as $produto){
                            
                            ?>
                            <tr class="sacola-item">
                                <td style="width:25px; margin: 0 20px 0 0">
                                    <input type="checkbox" name="pedido[]" value="<?php echo $produto['codproduto'];?>">
                                </td>
                                <td class="tb-foto">
                                    <img width="64px" src="../image/produtos/<?php echo $produto['foto']?>">
                                </td>
                                <td>
                                    <?php echo $produto['nome']?>
                                </td>
                                <td>
                                    <div class="qtd">
                                        <?php echo $produto['qtd']?>
                                        <a href="remove_item.php?produto=<?php echo $produto['codproduto']?>&sacola=<?php echo $codsacola?>">Remover</a>
                                    </div>
                                </td>
                                <td>
                                    R$<?php echo (number_format($produto['valor']*$produto['qtd'],2))?>
                                    
                                </td>
                            </tr>
                        <?php
                        }?>                    
                    </table>

                    <input type="hidden" name="codsacola" value="<?php echo $codsacola?>">
                    <input type="hidden" name="codpessoa" value="<?php echo $_SESSION['codpessoa'] ?>">
                    <div class="finaliza">
                        <input width="200px" type="submit" id="finaliza" name="botao" value="Finalizar pedido">
                    </div>

                </form>
                <?php
            }
        }




    ?>
</body>

<?php
    require_once('../includes/footer.php');
?>

<script>

    window.onload = function(){

        if(document.getElementById("form")){        
            let botao = document.getElementById('form');
            botao.addEventListener('submit',confirmacao)
        }
        
        let btn = document.getElementById('btn')
        btn.addEventListener('click',menuShow)
    }

    function confirmacao(){
        let loja = document.getElementById('titulo')
        let aux = confirm('Deseja finalizar o pedido da loja: '+loja.value)
        if(!aux){
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

