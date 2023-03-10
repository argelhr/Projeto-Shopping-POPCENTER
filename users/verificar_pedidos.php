<body id='pagperfil'>
    
    <?php
        require_once('../includes/header.php');
        require_once('../includes/menu-user.php');
        require_once('../controllers/funcoes_db.php');
        
        $sql = 'SELECT NF from vendas where codpessoa = ?';
        $array = array($_SESSION['codpessoa']);
        
        $NFS = ConsultaSelectAll($sql,$array);

          ?>

    <h2 class="titulo">Pedidos</h2>

    
        
            <?php
                if($NFS){
                    foreach($NFS as $NF){
                        ?>
                        <div style="margin-bottom: 24px;" class="sacola-loja">
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
                                                echo 'Aguardando Lojista';
                                            else
                                                echo 'Liberado'
                                        ?>
                                    </td>
                                </tr>
                            <?php
                        }
                        ?>
                        </table>
                        </div>
                        <?php
                    }
                }
                else{
                    ?>
                        <div style="display:flex; flex-direction:column; align-items:center">
                            <div>
                                <img width="192px" style="mix-blend-mode: multiply; border-radius:3px" src="../image/EQSJqasW4AMIcIj.jpg" alt="">
                            </div>
                        <div>N??o h?? pedidos realizados</div>
                    <?php
                }
            ?>
        
    


    
</body>

<?php
    require_once('../includes/footer.php');
?>

<script>

    window.onresize = start;//evento de mudan??a de tamanho de tela

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