<body id='pagperfil'>
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');

        $sql = 'SELECT DISTINCT (vendas.NF) from vendas join vendas_produtos using (NF) join produtos using(codproduto) join lojas using (codloja) where lojas.codpessoa = ?';
        $array = array($_SESSION['codpessoa']);

        $NFS = ConsultaSelectALL($sql,$array);
?>

        <h2 class="titulo">Pedidos dos Clientes</h2>
        <?php

        require_once('../includes/mensagem_sessao.php');

            if($NFS){
                foreach($NFS as $NF){
                    ?>
                    <form method="post" action="../controllers/controller_lojas.php" style="margin-bottom: 24px;" class="sacola-loja">
                        <h3>Nota fiscal:<?php echo $NF['NF']?></h3>
                        <table class="sacola-items">
                            <tr>
                                <th>Foto</th>
                                <th>Nome</th>
                                <th>Qtd</th>
                                <th style="margin: 8px;">Valor</th>
                                <th style="margin: 8px;">Status</th>
                            </tr>
                            <?php

                            $sql = 'SELECT * from produtos join vendas_produtos using (codproduto) join vendas using (NF) where NF = ?';
                            $array = array($NF['NF']);
                            $resultados = ConsultaSelectAll($sql,$array);

                            foreach($resultados as $item_pedido){
                                ?>
                                <tr class="sacola-item">
                                    <td class="tb-foto">
                                        <img width="64px" src="../image/produtos/<?php echo $item_pedido['foto']?>">
                                    </td>
                                    <td>
                                        <?php echo $item_pedido['nome']?>
                                    </td>
                                    <td>
                                        <div class="qtd">
                                            <?php echo $item_pedido['quantidade']?>
                                        </div>
                                    </td>
                                    <td>
                                        R$<?php echo ' '.(number_format($item_pedido['valor_total'],2))?>
                                    </td>
                                    <td>
                                        <?php 
                                            if(!$item_pedido['liberacao'])
                                                echo 'Aguardando Liberação';
                                            else
                                                echo 'Pedido Enviado'
                                        ?>
                                    </td>
                                </tr>
                                
                                <?php
                            }
                            ?>    
                        </table>
                        <?php
                            if(!$item_pedido['liberacao']){
                                ?>
                                <div class="center">
                                    <input type="hidden" name="nf" value="<?php echo $NF['NF']?>">
                                    <input id='finaliza' type="submit" name="botao" value="Enviar pedido">
                                </div>
                                <?php
                            }
                        ?>
                        </form>
                    <?php
                }
            }
            else{
                ?>
                    <div style="display:flex; flex-direction:column; align-items:center">
                            <div>
                                <img width="192px" style="mix-blend-mode: multiply; border-radius:3px" src="../image/EQSJqasW4AMIcIj.jpg" alt="">
                            </div>
                        <div>Ninguém solicitou produtos até o momento</div>
                    </div>
                <?php
            }
            ?>

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